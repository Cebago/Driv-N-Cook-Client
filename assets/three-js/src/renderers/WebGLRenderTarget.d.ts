import {Vector4} from './../math/Vector4';
import {Texture} from './../textures/Texture';
import {DepthTexture} from './../textures/DepthTexture';
import {EventDispatcher} from './../core/EventDispatcher';
import {TextureDataType, TextureFilter, Wrapping} from '../constants';

export interface WebGLRenderTargetOptions {
	wrapS?: Wrapping;
	wrapT?: Wrapping;
	magFilter?: TextureFilter;
	minFilter?: TextureFilter;
	format?: number; // RGBAFormat;
	type?: TextureDataType; // UnsignedByteType;
	anisotropy?: number; // 1;
	depthBuffer?: boolean; // true;
	stencilBuffer?: boolean; // true;
	generateMipmaps?: boolean; // true;
	depthTexture?: DepthTexture;
}

export class WebGLRenderTarget extends EventDispatcher {

	uuid: string;
	width: number;
	height: number;
	scissor: Vector4;
	scissorTest: boolean;
	viewport: Vector4;
	texture: Texture;
	depthBuffer: boolean;
	stencilBuffer: boolean;
	depthTexture: DepthTexture;
	readonly isWebGLRenderTarget: true;
	/**
	 * @deprecated Use {@link Texture#wrapS texture.wrapS} instead.
	 */
	wrapS: any;
	/**
	 * @deprecated Use {@link Texture#wrapT texture.wrapT} instead.
	 */
	wrapT: any;
	/**
	 * @deprecated Use {@link Texture#magFilter texture.magFilter} instead.
	 */
	magFilter: any;
	/**
	 * @deprecated Use {@link Texture#minFilter texture.minFilter} instead.
	 */
	minFilter: any;
	/**
	 * @deprecated Use {@link Texture#anisotropy texture.anisotropy} instead.
	 */
	anisotropy: any;
	/**
	 * @deprecated Use {@link Texture#offset texture.offset} instead.
	 */
	offset: any;
	/**
	 * @deprecated Use {@link Texture#repeat texture.repeat} instead.
	 */
	repeat: any;
	/**
	 * @deprecated Use {@link Texture#format texture.format} instead.
	 */
	format: any;
	/**
	 * @deprecated Use {@link Texture#type texture.type} instead.
	 */
	type: any;
	/**
	 * @deprecated Use {@link Texture#generateMipmaps texture.generateMipmaps} instead.
	 */
	generateMipmaps: any;

	constructor(
		width: number,
		height: number,
		options?: WebGLRenderTargetOptions
	);

	setSize(width: number, height: number): void;

	clone(): this;

	copy(source: WebGLRenderTarget): this;

	dispose(): void;

}
