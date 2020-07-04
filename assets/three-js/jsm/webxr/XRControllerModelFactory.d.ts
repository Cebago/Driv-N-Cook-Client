import {Group, Object3D, Texture} from '../../../src/Three';

import {GLTFLoader} from '../loaders/GLTFLoader';

export class XRControllerModel extends Object3D {

	motionController: any;

	constructor();

	setEnvironmentMap(envMap: Texture): XRControllerModel;

}

export class XRControllerModelFactory {

	gltfLoader: GLTFLoader | null;
	path: string;

	constructor(gltfLoader?: GLTFLoader);

	createControllerModel(controller: Group): XRControllerModel;

}
