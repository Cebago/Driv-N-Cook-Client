import {CompressedPixelFormat, CompressedTextureLoader, LoadingManager, PixelFormat} from '../../../src/Three';

export interface DDS {
	mipmaps: object[];
	width: number;
	height: number;
	format: PixelFormat | CompressedPixelFormat;
	mipmapCount: number;
	isCubemap: boolean;
}

export class DDSLoader extends CompressedTextureLoader {

	constructor(manager?: LoadingManager);

	parse(buffer: ArrayBuffer, loadMipmaps: boolean): DDS;

}
