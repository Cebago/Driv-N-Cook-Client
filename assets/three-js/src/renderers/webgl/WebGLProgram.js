/**
 * @author mrdoob / http://mrdoob.com/
 */

import {WebGLUniforms} from './WebGLUniforms.js';
import {WebGLShader} from './WebGLShader.js';
import {ShaderChunk} from '../shaders/ShaderChunk.js';
import {
	ACESFilmicToneMapping,
	AddOperation,
	CineonToneMapping,
	CubeReflectionMapping,
	CubeRefractionMapping,
	CubeUVReflectionMapping,
	CubeUVRefractionMapping,
	EquirectangularReflectionMapping,
	EquirectangularRefractionMapping,
	GammaEncoding,
	LinearEncoding,
	LinearToneMapping,
	LogLuvEncoding,
	MixOperation,
	MultiplyOperation,
	NoToneMapping,
	PCFShadowMap,
	PCFSoftShadowMap,
	ReinhardToneMapping,
	RGBDEncoding,
	RGBEEncoding,
	RGBM16Encoding,
	RGBM7Encoding,
	SphericalReflectionMapping,
	sRGBEncoding,
	Uncharted2ToneMapping,
	VSMShadowMap
} from '../../constants.js';

var programIdCount = 0;

function addLineNumbers(string) {

	var lines = string.split('\n');

	for (var i = 0; i < lines.length; i++) {

		lines[i] = (i + 1) + ': ' + lines[i];

	}

	return lines.join('\n');

}

function getEncodingComponents(encoding) {

	switch (encoding) {

		case LinearEncoding:
			return ['Linear', '( value )'];
		case sRGBEncoding:
			return ['sRGB', '( value )'];
		case RGBEEncoding:
			return ['RGBE', '( value )'];
		case RGBM7Encoding:
			return ['RGBM', '( value, 7.0 )'];
		case RGBM16Encoding:
			return ['RGBM', '( value, 16.0 )'];
		case RGBDEncoding:
			return ['RGBD', '( value, 256.0 )'];
		case GammaEncoding:
			return ['Gamma', '( value, float( GAMMA_FACTOR ) )'];
		case LogLuvEncoding:
			return ['LogLuv', '( value )'];
		default:
			throw new Error('unsupported encoding: ' + encoding);

	}

}

function getShaderErrors(gl, shader, type) {

	var status = gl.getShaderParameter(shader, gl.COMPILE_STATUS);
	var log = gl.getShaderInfoLog(shader).trim();

	if (status && log === '') return '';

	// --enable-privileged-webgl-extension
	// console.log( '**' + type + '**', gl.getExtension( 'WEBGL_debug_shaders' ).getTranslatedShaderSource( shader ) );

	var source = gl.getShaderSource(shader);

	return 'THREE.WebGLShader: gl.getShaderInfoLog() ' + type + '\n' + log + addLineNumbers(source);

}

function getTexelDecodingFunction(functionName, encoding) {

	var components = getEncodingComponents(encoding);
	return 'vec4 ' + functionName + '( vec4 value ) { return ' + components[0] + 'ToLinear' + components[1] + '; }';

}

function getTexelEncodingFunction(functionName, encoding) {

	var components = getEncodingComponents(encoding);
	return 'vec4 ' + functionName + '( vec4 value ) { return LinearTo' + components[0] + components[1] + '; }';

}

function getToneMappingFunction(functionName, toneMapping) {

	var toneMappingName;

	switch (toneMapping) {

		case LinearToneMapping:
			toneMappingName = 'Linear';
			break;

		case ReinhardToneMapping:
			toneMappingName = 'Reinhard';
			break;

		case Uncharted2ToneMapping:
			toneMappingName = 'Uncharted2';
			break;

		case CineonToneMapping:
			toneMappingName = 'OptimizedCineon';
			break;

		case ACESFilmicToneMapping:
			toneMappingName = 'ACESFilmic';
			break;

		default:
			throw new Error('unsupported toneMapping: ' + toneMapping);

	}

	return 'vec3 ' + functionName + '( vec3 color ) { return ' + toneMappingName + 'ToneMapping( color ); }';

}

function generateExtensions(parameters) {

	var chunks = [
		(parameters.extensionDerivatives || parameters.envMapCubeUV || parameters.bumpMap || parameters.tangentSpaceNormalMap || parameters.clearcoatNormalMap || parameters.flatShading || parameters.shaderID === 'physical') ? '#extension GL_OES_standard_derivatives : enable' : '',
		(parameters.extensionFragDepth || parameters.logarithmicDepthBuffer) && parameters.rendererExtensionFragDepth ? '#extension GL_EXT_frag_depth : enable' : '',
		(parameters.extensionDrawBuffers && parameters.rendererExtensionDrawBuffers) ? '#extension GL_EXT_draw_buffers : require' : '',
		(parameters.extensionShaderTextureLOD || parameters.envMap) && parameters.rendererExtensionShaderTextureLod ? '#extension GL_EXT_shader_texture_lod : enable' : ''
	];

	return chunks.filter(filterEmptyLine).join('\n');

}

function generateDefines(defines) {

	var chunks = [];

	for (var name in defines) {

		var value = defines[name];

		if (value === false) continue;

		chunks.push('#define ' + name + ' ' + value);

	}

	return chunks.join('\n');

}

function fetchAttributeLocations(gl, program) {

	var attributes = {};

	var n = gl.getProgramParameter(program, gl.ACTIVE_ATTRIBUTES);

	for (var i = 0; i < n; i++) {

		var info = gl.getActiveAttrib(program, i);
		var name = info.name;

		// console.log( 'THREE.WebGLProgram: ACTIVE VERTEX ATTRIBUTE:', name, i );

		attributes[name] = gl.getAttribLocation(program, name);

	}

	return attributes;

}

function filterEmptyLine(string) {

	return string !== '';

}

function replaceLightNums(string, parameters) {

	return string
		.replace(/NUM_DIR_LIGHTS/g, parameters.numDirLights)
		.replace(/NUM_SPOT_LIGHTS/g, parameters.numSpotLights)
		.replace(/NUM_RECT_AREA_LIGHTS/g, parameters.numRectAreaLights)
		.replace(/NUM_POINT_LIGHTS/g, parameters.numPointLights)
		.replace(/NUM_HEMI_LIGHTS/g, parameters.numHemiLights)
		.replace(/NUM_DIR_LIGHT_SHADOWS/g, parameters.numDirLightShadows)
		.replace(/NUM_SPOT_LIGHT_SHADOWS/g, parameters.numSpotLightShadows)
		.replace(/NUM_POINT_LIGHT_SHADOWS/g, parameters.numPointLightShadows);

}

function replaceClippingPlaneNums(string, parameters) {

	return string
		.replace(/NUM_CLIPPING_PLANES/g, parameters.numClippingPlanes)
		.replace(/UNION_CLIPPING_PLANES/g, (parameters.numClippingPlanes - parameters.numClipIntersection));

}

// Resolve Includes

var includePattern = /^[ \t]*#include +<([\w\d./]+)>/gm;

function resolveIncludes(string) {

	return string.replace(includePattern, includeReplacer);

}

function includeReplacer(match, include) {

	var string = ShaderChunk[include];

	if (string === undefined) {

		throw new Error('Can not resolve #include <' + include + '>');

	}

	return resolveIncludes(string);

}

// Unroll Loops

var deprecatedUnrollLoopPattern = /#pragma unroll_loop[\s]+?for \( int i \= (\d+)\; i < (\d+)\; i \+\+ \) \{([\s\S]+?)(?=\})\}/g;
var unrollLoopPattern = /#pragma unroll_loop_start[\s]+?for \( int i \= (\d+)\; i < (\d+)\; i \+\+ \) \{([\s\S]+?)(?=\})\}[\s]+?#pragma unroll_loop_end/g;

function unrollLoops(string) {

	return string
		.replace(unrollLoopPattern, loopReplacer)
		.replace(deprecatedUnrollLoopPattern, deprecatedLoopReplacer);

}

function deprecatedLoopReplacer(match, start, end, snippet) {

	console.warn('WebGLProgram: #pragma unroll_loop shader syntax is deprecated. Please use #pragma unroll_loop_start syntax instead.');
	return loopReplacer(match, start, end, snippet);

}

function loopReplacer(match, start, end, snippet) {

	var string = '';

	for (var i = parseInt(start); i < parseInt(end); i++) {

		string += snippet
			.replace(/\[ i \]/g, '[ ' + i + ' ]')
			.replace(/UNROLLED_LOOP_INDEX/g, i);

	}

	return string;

}

//

function generatePrecision(parameters) {

	var precisionstring = "precision " + parameters.precision + " float;\nprecision " + parameters.precision + " int;";

	if (parameters.precision === "highp") {

		precisionstring += "\n#define HIGH_PRECISION";

	} else if (parameters.precision === "mediump") {

		precisionstring += "\n#define MEDIUM_PRECISION";

	} else if (parameters.precision === "lowp") {

		precisionstring += "\n#define LOW_PRECISION";

	}

	return precisionstring;

}

function generateShadowMapTypeDefine(parameters) {

	var shadowMapTypeDefine = 'SHADOWMAP_TYPE_BASIC';

	if (parameters.shadowMapType === PCFShadowMap) {

		shadowMapTypeDefine = 'SHADOWMAP_TYPE_PCF';

	} else if (parameters.shadowMapType === PCFSoftShadowMap) {

		shadowMapTypeDefine = 'SHADOWMAP_TYPE_PCF_SOFT';

	} else if (parameters.shadowMapType === VSMShadowMap) {

		shadowMapTypeDefine = 'SHADOWMAP_TYPE_VSM';

	}

	return shadowMapTypeDefine;

}

function generateEnvMapTypeDefine(parameters) {

	var envMapTypeDefine = 'ENVMAP_TYPE_CUBE';

	if (parameters.envMap) {

		switch (parameters.envMapMode) {

			case CubeReflectionMapping:
			case CubeRefractionMapping:
				envMapTypeDefine = 'ENVMAP_TYPE_CUBE';
				break;

			case CubeUVReflectionMapping:
			case CubeUVRefractionMapping:
				envMapTypeDefine = 'ENVMAP_TYPE_CUBE_UV';
				break;

			case EquirectangularReflectionMapping:
			case EquirectangularRefractionMapping:
				envMapTypeDefine = 'ENVMAP_TYPE_EQUIREC';
				break;

			case SphericalReflectionMapping:
				envMapTypeDefine = 'ENVMAP_TYPE_SPHERE';
				break;

		}

	}

	return envMapTypeDefine;

}

function generateEnvMapModeDefine(parameters) {

	var envMapModeDefine = 'ENVMAP_MODE_REFLECTION';

	if (parameters.envMap) {

		switch (parameters.envMapMode) {

			case CubeRefractionMapping:
			case EquirectangularRefractionMapping:
				envMapModeDefine = 'ENVMAP_MODE_REFRACTION';
				break;

		}

	}

	return envMapModeDefine;

}

function generateEnvMapBlendingDefine(parameters) {

	var envMapBlendingDefine = 'ENVMAP_BLENDING_NONE';

	if (parameters.envMap) {

		switch (parameters.combine) {

			case MultiplyOperation:
				envMapBlendingDefine = 'ENVMAP_BLENDING_MULTIPLY';
				break;

			case MixOperation:
				envMapBlendingDefine = 'ENVMAP_BLENDING_MIX';
				break;

			case AddOperation:
				envMapBlendingDefine = 'ENVMAP_BLENDING_ADD';
				break;

		}

	}

	return envMapBlendingDefine;

}

function WebGLProgram(renderer, cacheKey, parameters) {

	var gl = renderer.getContext();

	var defines = parameters.defines;

	var vertexShader = parameters.vertexShader;
	var fragmentShader = parameters.fragmentShader;
	var shadowMapTypeDefine = generateShadowMapTypeDefine(parameters);
	var envMapTypeDefine = generateEnvMapTypeDefine(parameters);
	var envMapModeDefine = generateEnvMapModeDefine(parameters);
	var envMapBlendingDefine = generateEnvMapBlendingDefine(parameters);


	var gammaFactorDefine = (renderer.gammaFactor > 0) ? renderer.gammaFactor : 1.0;

	var customExtensions = parameters.isWebGL2 ? '' : generateExtensions(parameters);

	var customDefines = generateDefines(defines);

	var program = gl.createProgram();

	var prefixVertex, prefixFragment;

	if (parameters.isRawShaderMaterial) {

		prefixVertex = [

			customDefines

		].filter(filterEmptyLine).join('\n');

		if (prefixVertex.length > 0) {

			prefixVertex += '\n';

		}

		prefixFragment = [

			customExtensions,
			customDefines

		].filter(filterEmptyLine).join('\n');

		if (prefixFragment.length > 0) {

			prefixFragment += '\n';

		}

	} else {

		prefixVertex = [

			generatePrecision(parameters),

			'#define SHADER_NAME ' + parameters.shaderName,

			customDefines,

			parameters.instancing ? '#define USE_INSTANCING' : '',
			parameters.supportsVertexTextures ? '#define VERTEX_TEXTURES' : '',

			'#define GAMMA_FACTOR ' + gammaFactorDefine,

			'#define MAX_BONES ' + parameters.maxBones,
			(parameters.useFog && parameters.fog) ? '#define USE_FOG' : '',
			(parameters.useFog && parameters.fogExp2) ? '#define FOG_EXP2' : '',

			parameters.map ? '#define USE_MAP' : '',
			parameters.envMap ? '#define USE_ENVMAP' : '',
			parameters.envMap ? '#define ' + envMapModeDefine : '',
			parameters.lightMap ? '#define USE_LIGHTMAP' : '',
			parameters.aoMap ? '#define USE_AOMAP' : '',
			parameters.emissiveMap ? '#define USE_EMISSIVEMAP' : '',
			parameters.bumpMap ? '#define USE_BUMPMAP' : '',
			parameters.normalMap ? '#define USE_NORMALMAP' : '',
			(parameters.normalMap && parameters.objectSpaceNormalMap) ? '#define OBJECTSPACE_NORMALMAP' : '',
			(parameters.normalMap && parameters.tangentSpaceNormalMap) ? '#define TANGENTSPACE_NORMALMAP' : '',

			parameters.clearcoatMap ? '#define USE_CLEARCOATMAP' : '',
			parameters.clearcoatRoughnessMap ? '#define USE_CLEARCOAT_ROUGHNESSMAP' : '',
			parameters.clearcoatNormalMap ? '#define USE_CLEARCOAT_NORMALMAP' : '',
			parameters.displacementMap && parameters.supportsVertexTextures ? '#define USE_DISPLACEMENTMAP' : '',
			parameters.specularMap ? '#define USE_SPECULARMAP' : '',
			parameters.roughnessMap ? '#define USE_ROUGHNESSMAP' : '',
			parameters.metalnessMap ? '#define USE_METALNESSMAP' : '',
			parameters.alphaMap ? '#define USE_ALPHAMAP' : '',

			parameters.vertexTangents ? '#define USE_TANGENT' : '',
			parameters.vertexColors ? '#define USE_COLOR' : '',
			parameters.vertexUvs ? '#define USE_UV' : '',
			parameters.uvsVertexOnly ? '#define UVS_VERTEX_ONLY' : '',

			parameters.flatShading ? '#define FLAT_SHADED' : '',

			parameters.skinning ? '#define USE_SKINNING' : '',
			parameters.useVertexTexture ? '#define BONE_TEXTURE' : '',

			parameters.morphTargets ? '#define USE_MORPHTARGETS' : '',
			parameters.morphNormals && parameters.flatShading === false ? '#define USE_MORPHNORMALS' : '',
			parameters.doubleSided ? '#define DOUBLE_SIDED' : '',
			parameters.flipSided ? '#define FLIP_SIDED' : '',

			parameters.shadowMapEnabled ? '#define USE_SHADOWMAP' : '',
			parameters.shadowMapEnabled ? '#define ' + shadowMapTypeDefine : '',

			parameters.sizeAttenuation ? '#define USE_SIZEATTENUATION' : '',

			parameters.logarithmicDepthBuffer ? '#define USE_LOGDEPTHBUF' : '',
			(parameters.logarithmicDepthBuffer && parameters.rendererExtensionFragDepth) ? '#define USE_LOGDEPTHBUF_EXT' : '',

			'uniform mat4 modelMatrix;',
			'uniform mat4 modelViewMatrix;',
			'uniform mat4 projectionMatrix;',
			'uniform mat4 viewMatrix;',
			'uniform mat3 normalMatrix;',
			'uniform vec3 cameraPosition;',
			'uniform bool isOrthographic;',

			'#ifdef USE_INSTANCING',

			' attribute mat4 instanceMatrix;',

			'#endif',

			'attribute vec3 position;',
			'attribute vec3 normal;',
			'attribute vec2 uv;',

			'#ifdef USE_TANGENT',

			'	attribute vec4 tangent;',

			'#endif',

			'#ifdef USE_COLOR',

			'	attribute vec3 color;',

			'#endif',

			'#ifdef USE_MORPHTARGETS',

			'	attribute vec3 morphTarget0;',
			'	attribute vec3 morphTarget1;',
			'	attribute vec3 morphTarget2;',
			'	attribute vec3 morphTarget3;',

			'	#ifdef USE_MORPHNORMALS',

			'		attribute vec3 morphNormal0;',
			'		attribute vec3 morphNormal1;',
			'		attribute vec3 morphNormal2;',
			'		attribute vec3 morphNormal3;',

			'	#else',

			'		attribute vec3 morphTarget4;',
			'		attribute vec3 morphTarget5;',
			'		attribute vec3 morphTarget6;',
			'		attribute vec3 morphTarget7;',

			'	#endif',

			'#endif',

			'#ifdef USE_SKINNING',

			'	attribute vec4 skinIndex;',
			'	attribute vec4 skinWeight;',

			'#endif',

			'\n'

		].filter(filterEmptyLine).join('\n');

		prefixFragment = [

			customExtensions,

			generatePrecision(parameters),

			'#define SHADER_NAME ' + parameters.shaderName,

			customDefines,

			parameters.alphaTest ? '#define ALPHATEST ' + parameters.alphaTest + (parameters.alphaTest % 1 ? '' : '.0') : '', // add '.0' if integer

			'#define GAMMA_FACTOR ' + gammaFactorDefine,

			(parameters.useFog && parameters.fog) ? '#define USE_FOG' : '',
			(parameters.useFog && parameters.fogExp2) ? '#define FOG_EXP2' : '',

			parameters.map ? '#define USE_MAP' : '',
			parameters.matcap ? '#define USE_MATCAP' : '',
			parameters.envMap ? '#define USE_ENVMAP' : '',
			parameters.envMap ? '#define ' + envMapTypeDefine : '',
			parameters.envMap ? '#define ' + envMapModeDefine : '',
			parameters.envMap ? '#define ' + envMapBlendingDefine : '',
			parameters.lightMap ? '#define USE_LIGHTMAP' : '',
			parameters.aoMap ? '#define USE_AOMAP' : '',
			parameters.emissiveMap ? '#define USE_EMISSIVEMAP' : '',
			parameters.bumpMap ? '#define USE_BUMPMAP' : '',
			parameters.normalMap ? '#define USE_NORMALMAP' : '',
			(parameters.normalMap && parameters.objectSpaceNormalMap) ? '#define OBJECTSPACE_NORMALMAP' : '',
			(parameters.normalMap && parameters.tangentSpaceNormalMap) ? '#define TANGENTSPACE_NORMALMAP' : '',
			parameters.clearcoatMap ? '#define USE_CLEARCOATMAP' : '',
			parameters.clearcoatRoughnessMap ? '#define USE_CLEARCOAT_ROUGHNESSMAP' : '',
			parameters.clearcoatNormalMap ? '#define USE_CLEARCOAT_NORMALMAP' : '',
			parameters.specularMap ? '#define USE_SPECULARMAP' : '',
			parameters.roughnessMap ? '#define USE_ROUGHNESSMAP' : '',
			parameters.metalnessMap ? '#define USE_METALNESSMAP' : '',
			parameters.alphaMap ? '#define USE_ALPHAMAP' : '',

			parameters.sheen ? '#define USE_SHEEN' : '',

			parameters.vertexTangents ? '#define USE_TANGENT' : '',
			parameters.vertexColors ? '#define USE_COLOR' : '',
			parameters.vertexUvs ? '#define USE_UV' : '',
			parameters.uvsVertexOnly ? '#define UVS_VERTEX_ONLY' : '',

			parameters.gradientMap ? '#define USE_GRADIENTMAP' : '',

			parameters.flatShading ? '#define FLAT_SHADED' : '',

			parameters.doubleSided ? '#define DOUBLE_SIDED' : '',
			parameters.flipSided ? '#define FLIP_SIDED' : '',

			parameters.shadowMapEnabled ? '#define USE_SHADOWMAP' : '',
			parameters.shadowMapEnabled ? '#define ' + shadowMapTypeDefine : '',

			parameters.premultipliedAlpha ? '#define PREMULTIPLIED_ALPHA' : '',

			parameters.physicallyCorrectLights ? '#define PHYSICALLY_CORRECT_LIGHTS' : '',

			parameters.logarithmicDepthBuffer ? '#define USE_LOGDEPTHBUF' : '',
			(parameters.logarithmicDepthBuffer && parameters.rendererExtensionFragDepth) ? '#define USE_LOGDEPTHBUF_EXT' : '',

			((parameters.extensionShaderTextureLOD || parameters.envMap) && parameters.rendererExtensionShaderTextureLod) ? '#define TEXTURE_LOD_EXT' : '',

			'uniform mat4 viewMatrix;',
			'uniform vec3 cameraPosition;',
			'uniform bool isOrthographic;',

			(parameters.toneMapping !== NoToneMapping) ? '#define TONE_MAPPING' : '',
			(parameters.toneMapping !== NoToneMapping) ? ShaderChunk['tonemapping_pars_fragment'] : '', // this code is required here because it is used by the toneMapping() function defined below
			(parameters.toneMapping !== NoToneMapping) ? getToneMappingFunction('toneMapping', parameters.toneMapping) : '',

			parameters.dithering ? '#define DITHERING' : '',

			(parameters.outputEncoding || parameters.mapEncoding || parameters.matcapEncoding || parameters.envMapEncoding || parameters.emissiveMapEncoding || parameters.lightMapEncoding) ?
				ShaderChunk['encodings_pars_fragment'] : '', // this code is required here because it is used by the various encoding/decoding function defined below
			parameters.mapEncoding ? getTexelDecodingFunction('mapTexelToLinear', parameters.mapEncoding) : '',
			parameters.matcapEncoding ? getTexelDecodingFunction('matcapTexelToLinear', parameters.matcapEncoding) : '',
			parameters.envMapEncoding ? getTexelDecodingFunction('envMapTexelToLinear', parameters.envMapEncoding) : '',
			parameters.emissiveMapEncoding ? getTexelDecodingFunction('emissiveMapTexelToLinear', parameters.emissiveMapEncoding) : '',
			parameters.lightMapEncoding ? getTexelDecodingFunction('lightMapTexelToLinear', parameters.lightMapEncoding) : '',
			parameters.outputEncoding ? getTexelEncodingFunction('linearToOutputTexel', parameters.outputEncoding) : '',

			parameters.depthPacking ? '#define DEPTH_PACKING ' + parameters.depthPacking : '',

			'\n'

		].filter(filterEmptyLine).join('\n');

	}

	vertexShader = resolveIncludes(vertexShader);
	vertexShader = replaceLightNums(vertexShader, parameters);
	vertexShader = replaceClippingPlaneNums(vertexShader, parameters);

	fragmentShader = resolveIncludes(fragmentShader);
	fragmentShader = replaceLightNums(fragmentShader, parameters);
	fragmentShader = replaceClippingPlaneNums(fragmentShader, parameters);

	vertexShader = unrollLoops(vertexShader);
	fragmentShader = unrollLoops(fragmentShader);

	if (parameters.isWebGL2 && !parameters.isRawShaderMaterial) {

		var isGLSL3ShaderMaterial = false;

		var versionRegex = /^\s*#version\s+300\s+es\s*\n/;

		if (parameters.isShaderMaterial &&
			vertexShader.match(versionRegex) !== null &&
			fragmentShader.match(versionRegex) !== null) {

			isGLSL3ShaderMaterial = true;

			vertexShader = vertexShader.replace(versionRegex, '');
			fragmentShader = fragmentShader.replace(versionRegex, '');

		}

		// GLSL 3.0 conversion

		prefixVertex = [
			'#version 300 es\n',
			'#define attribute in',
			'#define varying out',
			'#define texture2D texture'
		].join('\n') + '\n' + prefixVertex;

		prefixFragment = [
			'#version 300 es\n',
			'#define varying in',
			isGLSL3ShaderMaterial ? '' : 'out highp vec4 pc_fragColor;',
			isGLSL3ShaderMaterial ? '' : '#define gl_FragColor pc_fragColor',
			'#define gl_FragDepthEXT gl_FragDepth',
			'#define texture2D texture',
			'#define textureCube texture',
			'#define texture2DProj textureProj',
			'#define texture2DLodEXT textureLod',
			'#define texture2DProjLodEXT textureProjLod',
			'#define textureCubeLodEXT textureLod',
			'#define texture2DGradEXT textureGrad',
			'#define texture2DProjGradEXT textureProjGrad',
			'#define textureCubeGradEXT textureGrad'
		].join('\n') + '\n' + prefixFragment;

	}

	var vertexGlsl = prefixVertex + vertexShader;
	var fragmentGlsl = prefixFragment + fragmentShader;

	// console.log( '*VERTEX*', vertexGlsl );
	// console.log( '*FRAGMENT*', fragmentGlsl );

	var glVertexShader = WebGLShader(gl, gl.VERTEX_SHADER, vertexGlsl);
	var glFragmentShader = WebGLShader(gl, gl.FRAGMENT_SHADER, fragmentGlsl);

	gl.attachShader(program, glVertexShader);
	gl.attachShader(program, glFragmentShader);

	// Force a particular attribute to index 0.

	if (parameters.index0AttributeName !== undefined) {

		gl.bindAttribLocation(program, 0, parameters.index0AttributeName);

	} else if (parameters.morphTargets === true) {

		// programs with morphTargets displace position out of attribute 0
		gl.bindAttribLocation(program, 0, 'position');

	}

	gl.linkProgram(program);

	// check for link errors
	if (renderer.debug.checkShaderErrors) {

		var programLog = gl.getProgramInfoLog(program).trim();
		var vertexLog = gl.getShaderInfoLog(glVertexShader).trim();
		var fragmentLog = gl.getShaderInfoLog(glFragmentShader).trim();

		var runnable = true;
		var haveDiagnostics = true;

		if (gl.getProgramParameter(program, gl.LINK_STATUS) === false) {

			runnable = false;

			var vertexErrors = getShaderErrors(gl, glVertexShader, 'vertex');
			var fragmentErrors = getShaderErrors(gl, glFragmentShader, 'fragment');

			console.error('THREE.WebGLProgram: shader error: ', gl.getError(), 'gl.VALIDATE_STATUS', gl.getProgramParameter(program, gl.VALIDATE_STATUS), 'gl.getProgramInfoLog', programLog, vertexErrors, fragmentErrors);

		} else if (programLog !== '') {

			console.warn('THREE.WebGLProgram: gl.getProgramInfoLog()', programLog);

		} else if (vertexLog === '' || fragmentLog === '') {

			haveDiagnostics = false;

		}

		if (haveDiagnostics) {

			this.diagnostics = {

				runnable: runnable,

				programLog: programLog,

				vertexShader: {

					log: vertexLog,
					prefix: prefixVertex

				},

				fragmentShader: {

					log: fragmentLog,
					prefix: prefixFragment

				}

			};

		}

	}

	// Clean up

	// Crashes in iOS9 and iOS10. #18402
	// gl.detachShader( program, glVertexShader );
	// gl.detachShader( program, glFragmentShader );

	gl.deleteShader(glVertexShader);
	gl.deleteShader(glFragmentShader);

	// set up caching for uniform locations

	var cachedUniforms;

	this.getUniforms = function () {

		if (cachedUniforms === undefined) {

			cachedUniforms = new WebGLUniforms(gl, program);

		}

		return cachedUniforms;

	};

	// set up caching for attribute locations

	var cachedAttributes;

	this.getAttributes = function () {

		if (cachedAttributes === undefined) {

			cachedAttributes = fetchAttributeLocations(gl, program);

		}

		return cachedAttributes;

	};

	// free resource

	this.destroy = function () {

		gl.deleteProgram(program);
		this.program = undefined;

	};

	//

	this.name = parameters.shaderName;
	this.id = programIdCount++;
	this.cacheKey = cacheKey;
	this.usedTimes = 1;
	this.program = program;
	this.vertexShader = glVertexShader;
	this.fragmentShader = glFragmentShader;

	return this;

}

export {WebGLProgram};
