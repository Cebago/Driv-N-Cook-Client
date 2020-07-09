export interface WebGLCapabilitiesParameters {
	precision?: string;
	logarithmicDepthBuffer?: boolean;
}

export class WebGLCapabilities {

	readonly isWebGL2: true;
	precision: string;
	logarithmicDepthBuffer: boolean;
	maxTextures: number;
	maxVertexTextures: number;
	maxTextureSize: number;
	maxCubemapSize: number;
	maxAttributes: number;
	maxVertexUniforms: number;
	maxVaryings: number;
	maxFragmentUniforms: number;
	vertexTextures: boolean;
	floatFragmentTextures: boolean;
	floatVertexTextures: boolean;

	constructor(
		gl: WebGLRenderingContext,
		extensions: any,
		parameters: WebGLCapabilitiesParameters
	);

	getMaxAnisotropy(): number;

	getMaxPrecision(precision: string): string;

}
