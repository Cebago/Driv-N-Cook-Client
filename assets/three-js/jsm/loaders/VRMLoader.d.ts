import {Loader, LoadingManager} from '../../../src/Three';

import {GLTF, GLTFLoader} from './GLTFLoader';
import {DRACOLoader} from './DRACOLoader';

export class VRMLoader extends Loader {

	gltfLoader: GLTFLoader;

	constructor(manager?: LoadingManager);

	load(url: string, onLoad: (scene: GLTF) => void, onProgress?: (event: ProgressEvent) => void, onError?: (event: ErrorEvent) => void): void;

	parse(gltf: GLTF, onLoad: (scene: GLTF) => void): void;

	setDRACOLoader(dracoLoader: DRACOLoader): this;

}
