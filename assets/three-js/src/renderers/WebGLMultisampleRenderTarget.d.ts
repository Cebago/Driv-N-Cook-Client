import {WebGLRenderTarget, WebGLRenderTargetOptions,} from './WebGLRenderTarget';

export class WebGLMultisampleRenderTarget extends WebGLRenderTarget {

	readonly isWebGLMultisampleRenderTarget: true;
	/**
	 * Specifies the number of samples to be used for the renderbuffer storage.However, the maximum supported size for multisampling is platform dependent and defined via gl.MAX_SAMPLES.
	 */
	samples: number;

	constructor(
		width: number,
		height: number,
		options?: WebGLRenderTargetOptions
	);

}
