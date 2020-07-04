import {Group, Loader, LoadingManager} from '../../../src/Three';

export class ThreeMFLoader extends Loader {

	availableExtensions: object[];

	constructor(manager?: LoadingManager);

	load(url: string, onLoad: (object: Group) => void, onProgress?: (event: ProgressEvent) => void, onError?: (event: ErrorEvent) => void): void;

	parse(data: ArrayBuffer): Group;

	addExtension(extension: object): void

}
