import {Texture} from './Texture';
import {Mapping, PixelFormat, TextureDataType, TextureEncoding, TextureFilter, Wrapping,} from '../constants';

export class CubeTexture extends Texture {

	images: any; // returns and sets the value of Texture.image in the codde ?

	constructor(
		images?: any[], // HTMLImageElement or HTMLCanvasElement
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

}
