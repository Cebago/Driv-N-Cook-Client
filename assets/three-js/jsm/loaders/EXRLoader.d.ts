import {DataTextureLoader, LoadingManager, PixelFormat, TextureDataType} from '../../../src/Three';

export interface EXR {
	header: object;
	width: number;
	height: number;
	data: Float32Array;
	format: PixelFormat;
	type: TextureDataType;
}

export class EXRLoader extends DataTextureLoader {

	type: TextureDataType;

	constructor(manager?: LoadingManager);

	parse(buffer: ArrayBuffer): EXR;

	setDataType(type: TextureDataType): this;

}
