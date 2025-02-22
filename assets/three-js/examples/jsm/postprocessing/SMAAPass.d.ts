import {ShaderMaterial, Texture, WebGLRenderTarget} from '../../../src/Three';

import {Pass} from './Pass';

export class SMAAPass extends Pass {

	edgesRT: WebGLRenderTarget;
	weightsRT: WebGLRenderTarget;
	areaTexture: Texture;
	searchTexture: Texture;
	uniformsEdges: object;
	materialEdges: ShaderMaterial;
	uniformsWeights: object;
	materialWeights: ShaderMaterial;
	uniformsBlend: object;
	materialBlend: ShaderMaterial;
	fsQuad: object;

	constructor(width: number, height: number);

	getAreaTexture(): string;

	getSearchTexture(): string;

}
