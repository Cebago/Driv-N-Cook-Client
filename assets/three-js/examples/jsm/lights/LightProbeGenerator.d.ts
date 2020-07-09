import {CubeTexture, LightProbe, WebGLCubeRenderTarget, WebGLRenderer,} from '../../../src/Three';

export namespace LightProbeGenerator {

	export function fromCubeTexture(cubeTexture: CubeTexture): LightProbe;

	export function fromCubeRenderTarget(renderer: WebGLRenderer, cubeRenderTarget: WebGLCubeRenderTarget): LightProbe;

}
