import {Group, Loader, LoadingManager} from '../../../src/Three';

export class GCodeLoader extends Loader {

	splitLayer: boolean;

	constructor(manager?: LoadingManager);

	load(url: string, onLoad: (object: Group) => void, onProgress?: (event: ProgressEvent) => void, onError?: (event: ErrorEvent) => void): void;

	parse(data: string): Group;

}
