import {LoadingManager} from './LoadingManager';

/**
 * Base class for implementing loaders.
 */
export class Loader {

	crossOrigin: string;
	path: string;
	resourcePath: string;
	manager: LoadingManager;

	constructor(manager?: LoadingManager);

	/*
	load(): void;
	parse(): void;
	*/

	loadAsync(url: string, onProgress?: (event: ProgressEvent) => void): Promise<any>;

	setCrossOrigin(crossOrigin: string): this;

	setPath(path: string): this;

	setResourcePath(resourcePath: string): this;

}
