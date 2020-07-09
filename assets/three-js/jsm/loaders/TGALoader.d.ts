import {Loader, LoadingManager, Texture} from '../../../src/Three';

export class TGALoader extends Loader {

	constructor(manager?: LoadingManager);

	load(url: string, onLoad: (texture: Texture) => void, onProgress?: (event: ProgressEvent) => void, onError?: (event: ErrorEvent) => void): void;

	parse(data: ArrayBuffer): Texture;

}
