import {Vector2} from './../math/Vector2';
import {EventDispatcher} from './../core/EventDispatcher';
import {
	Mapping,
	PixelFormat,
	PixelFormatGPU,
	TextureDataType,
	TextureEncoding,
	TextureFilter,
	Wrapping
} from '../constants';

// Textures /////////////////////////////////////////////////////////////////////
export let TextureIdCount: number;

export class Texture extends EventDispatcher {

	static DEFAULT_IMAGE: any;
	static DEFAULT_MAPPING: any;
	id: number;
	uuid: string;
	name: string;
	sourceFile: string;
	image: any; // HTMLImageElement or ImageData or { width: number, height: number } in some children;
	mipmaps: ImageData[];
	mapping: Mapping;
	wrapS: Wrapping;
	wrapT: Wrapping;
	magFilter: TextureFilter;
	minFilter: TextureFilter;
	anisotropy: number;
	format: PixelFormat;
	internalFormat: PixelFormatGPU | null;
	type: TextureDataType;
	offset: Vector2;
	repeat: Vector2;
	center: Vector2;
	rotation: number;
	generateMipmaps: boolean;
	premultiplyAlpha: boolean;
	flipY: boolean;
	unpackAlignment: number;
	encoding: TextureEncoding;
	version: number;
	needsUpdate: boolean;
	readonly isTexture: true;
	onUpdate: () => void;

	constructor(
		image?: HTMLImageElement | HTMLCanvasElement | HTMLVideoElement,
		mapping?: Mapping,
		wrapS?: Wrapping,
		wrapT?: Wrapping,
		magFilter?: TextureFilter,
		minFilter?: TextureFilter,
		format?: PixelFormat,
		type?: TextureDataType,
		anisotropy?: number,
		encoding?: TextureEncoding
	);

	clone(): this;

	copy(source: Texture): this;

	toJSON(meta: any): any;

	dispose(): void;

	transformUv(uv: Vector2): Vector2;

}
