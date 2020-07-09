import {Texture} from './Texture';
import {Mapping, PixelFormat, TextureDataType, TextureFilter, Wrapping,} from '../constants';

export class VideoTexture extends Texture {

	readonly isVideoTexture: true;

	constructor(
		video: HTMLVideoElement,
		mapping?: Mapping,
		wrapS?: Wrapping,
		wrapT?: Wrapping,
		magFilter?: TextureFilter,
		minFilter?: TextureFilter,
		format?: PixelFormat,
		type?: TextureDataType,
		anisotropy?: number
	);

}
