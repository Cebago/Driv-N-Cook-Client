import {Texture} from './Texture';
import {Mapping, TextureDataType, TextureFilter, Wrapping,} from '../constants';

export class DepthTexture extends Texture {

	image: { width: number; height: number };

	constructor(
		width: number,
		heighht: number,
		type?: TextureDataType,
		mapping?: Mapping,
		wrapS?: Wrapping,
		wrapT?: Wrapping,
		magFilter?: TextureFilter,
		minFilter?: TextureFilter,
		anisotropy?: number
	);

}
