import {Loader} from './Loader';
import {LoadingManager} from './LoadingManager';
import {Font} from './../extras/core/Font';

export class FontLoader extends Loader {

	constructor(manager?: LoadingManager);

	load(
		url: string,
		onLoad?: (responseFont: Font) => void,
		onProgress?: (event: ProgressEvent) => void,
		onError?: (event: ErrorEvent) => void
	): void;

	parse(json: any): Font;

}
