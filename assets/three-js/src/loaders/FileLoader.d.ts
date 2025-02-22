import {Loader} from './Loader';
import {LoadingManager} from './LoadingManager';

export class FileLoader extends Loader {

	mimeType: undefined | MimeType;
	responseType: undefined | string;
	withCredentials: undefined | string;
	requestHeader: undefined | { [header: string]: string };

	constructor(manager?: LoadingManager);

	load(
		url: string,
		onLoad?: (response: string | ArrayBuffer) => void,
		onProgress?: (request: ProgressEvent) => void,
		onError?: (event: ErrorEvent) => void
	): any;

	setMimeType(mimeType: MimeType): FileLoader;

	setResponseType(responseType: string): FileLoader;

	setWithCredentials(value: boolean): FileLoader;

	setRequestHeader(value: { [header: string]: string }): FileLoader;

}
