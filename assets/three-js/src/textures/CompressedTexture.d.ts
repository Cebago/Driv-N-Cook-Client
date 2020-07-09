import {Texture} from './Texture';
import {CompressedPixelFormat, Mapping, TextureDataType, TextureEncoding, TextureFilter, Wrapping,} from '../constants';

export class CompressedTexture extends Texture {

	image: { width: number; height: number };

	constructor(
		mipmaps: ImageData[],
		width: number,
		height: number,
		format?: CompressedPixelFormat,
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
