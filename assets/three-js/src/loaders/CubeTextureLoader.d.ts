import {Loader} from './Loader';
import {LoadingManager} from './LoadingManager';
import {CubeTexture} from './../textures/CubeTexture';

export class CubeTextureLoader extends Loader {

	constructor(manager?: LoadingManager);

	load(
		urls: Array<string>,
		onLoad?: (texture: CubeTexture) => void,
		onProgress?: (event: ProgressEvent) => void,
		onError?: (event: ErrorEvent) => void
	): CubeTexture;

}
