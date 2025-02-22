import {IUniform} from '../renderers/shaders/UniformsLib';
import {Material, MaterialParameters} from './Material';

/**
 * @deprecated Use {@link PointsMaterial THREE.PointsMaterial} instead
 */

/**
 * @deprecated Use {@link PointsMaterial THREE.PointsMaterial} instead
 */
/**
 * @deprecated Use {@link PointsMaterial THREE.PointsMaterial} instead
 */

export interface ShaderMaterialParameters extends MaterialParameters {
	uniforms?: any;
	vertexShader?: string;
	fragmentShader?: string;
	linewidth?: number;
	wireframe?: boolean;
	wireframeLinewidth?: number;
	lights?: boolean;
	clipping?: boolean;
	skinning?: boolean;
	morphTargets?: boolean;
	morphNormals?: boolean;
	extensions?: {
		derivatives?: boolean;
		fragDepth?: boolean;
		drawBuffers?: boolean;
		shaderTextureLOD?: boolean;
	};
}

export class ShaderMaterial extends Material {

	uniforms: { [uniform: string]: IUniform };
	vertexShader: string;
	fragmentShader: string;
	linewidth: number;
	wireframe: boolean;
	wireframeLinewidth: number;
	lights: boolean;
	clipping: boolean;
	skinning: boolean;
	morphTargets: boolean;
	morphNormals: boolean;
	/**
	 * @deprecated Use {@link ShaderMaterial#extensions.derivatives extensions.derivatives} instead.
	 */
	derivatives: any;
	extensions: {
		derivatives: boolean;
		fragDepth: boolean;
		drawBuffers: boolean;
		shaderTextureLOD: boolean;
	};
	defaultAttributeValues: any;
	index0AttributeName: string | undefined;
	uniformsNeedUpdate: boolean;

	constructor(parameters?: ShaderMaterialParameters);

	setValues(parameters: ShaderMaterialParameters): void;

	toJSON(meta: any): any;

}
