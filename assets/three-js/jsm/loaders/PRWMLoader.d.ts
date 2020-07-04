import {BufferGeometry, Loader, LoadingManager} from '../../../src/Three';


export class PRWMLoader extends Loader {

	constructor(manager?: LoadingManager);

	static isBigEndianPlatform(): boolean;

	load(url: string, onLoad: (geometry: BufferGeometry) => void, onProgress?: (event: ProgressEvent) => void, onError?: (event: ErrorEvent) => void): void;

	parse(data: ArrayBuffer): BufferGeometry;

}
