import {ShaderMaterial, WebGLRenderTarget} from '../../../src/Three';

import {Pass} from './Pass';

export class BloomPass extends Pass {

	renderTargetX: WebGLRenderTarget;
	renderTargetY: WebGLRenderTarget;
	copyUniforms: object;
	materialCopy: ShaderMaterial;
	convolutionUniforms: object;
	materialConvolution: ShaderMaterial;
	fsQuad: object;

	constructor(strength?: number, kernelSize?: number, sigma?: number, resolution?: number);

}
