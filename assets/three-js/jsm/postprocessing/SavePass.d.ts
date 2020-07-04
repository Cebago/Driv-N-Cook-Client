import {ShaderMaterial, WebGLRenderTarget} from '../../../src/Three';

import {Pass} from './Pass';

export class SavePass extends Pass {

	textureID: string;
	renderTarget: WebGLRenderTarget;
	uniforms: object;
	material: ShaderMaterial;
	fsQuad: object;

	constructor(renderTarget: WebGLRenderTarget);

}
