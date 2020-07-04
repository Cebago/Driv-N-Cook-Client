import {Texture} from './Texture';
import {Mapping, PixelFormat, TextureDataType, TextureEncoding, TextureFilter, Wrapping,} from '../constants';
import {TypedArray} from '../polyfills';

export class DataTexture extends Texture {

	image: ImageData;

	constructor(
		data: TypedArray,
		width: number,
		height: number,
		format?: PixelFormat,
		type?: TextureDataType,
		mapping?: Mapping,
		wrapS?: Wrapping,
		wrapT?: Wrapping,
		magFilter?: TextureFilter,
		minFilter?: TextureFilter,
		anisotropy?: number,
		encoding?: TextureEncoding
	);

}
