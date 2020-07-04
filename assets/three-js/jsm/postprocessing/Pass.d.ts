import {Material, WebGLRenderer, WebGLRenderTarget} from '../../../src/Three';

export class Pass {

	enabled: boolean;
	needsSwap: boolean;
	clear: boolean;
	renderToScreen: boolean;

	constructor();

	setSize(width: number, height: number): void;

	render(renderer: WebGLRenderer, writeBuffer: WebGLRenderTarget, readBuffer: WebGLRenderTarget, deltaTime: number, maskActive: boolean): void;

}

export namespace Pass {
	class FullScreenQuad {

		material: Material;

		constructor(material?: Material);

		render(renderer: WebGLRenderer): void;

		dispose(): void;

	}
}
