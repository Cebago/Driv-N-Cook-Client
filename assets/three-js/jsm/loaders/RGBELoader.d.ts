import {DataTextureLoader, LoadingManager, PixelFormat, TextureDataType} from '../../../src/Three';

export interface RGBE {
	width: number;
	height: number;
	data: Float32Array | Uint8Array;
	header: string;
	gamma: number;
	exposure: number;
	format: PixelFormat;
	type: TextureDataType;
}

export class RGBELoader extends DataTextureLoader {

	type: TextureDataType;

	constructor(manager?: LoadingManager);

	parse(buffer: ArrayBuffer): RGBE;

	setDataType(type: TextureDataType): this;

}
