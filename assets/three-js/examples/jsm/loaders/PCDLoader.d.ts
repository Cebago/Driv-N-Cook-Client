import {Loader, LoadingManager, Points} from '../../../src/Three';


export class PCDLoader extends Loader {

	littleEndian: boolean;

	constructor(manager?: LoadingManager);

	load(url: string, onLoad: (points: Points) => void, onProgress?: (event: ProgressEvent) => void, onError?: (event: ErrorEvent) => void): void;

	parse(data: ArrayBuffer | string, url: string): Points;

}
