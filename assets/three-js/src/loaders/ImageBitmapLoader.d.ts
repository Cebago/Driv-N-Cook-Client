import {Loader} from './Loader';
import {LoadingManager} from './LoadingManager';

export class ImageBitmapLoader extends Loader {

	options: undefined | object;

	constructor(manager?: LoadingManager);

	setOptions(options: object): ImageBitmapLoader;

	load(
		url: string,
		onLoad?: (response: ImageBitmap) => void,
		onProgress?: (request: ProgressEvent) => void,
		onError?: (event: ErrorEvent) => void
	): any;

}
