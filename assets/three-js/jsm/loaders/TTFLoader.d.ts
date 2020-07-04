import {Loader, LoadingManager} from '../../../src/Three';

export class TTFLoader extends Loader {

	reversed: boolean;

	constructor(manager?: LoadingManager);

	load(url: string, onLoad: (json: object) => void, onProgress?: (event: ProgressEvent) => void, onError?: (event: ErrorEvent) => void): void;

	parse(arraybuffer: ArrayBuffer): object;

}
