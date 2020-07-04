import {Camera, Scene,} from '../../../src/Three';

import {Pass} from './Pass';

export class MaskPass extends Pass {

	scene: Scene;
	camera: Camera;
	inverse: boolean;

	constructor(scene: Scene, camera: Camera);

}

export class ClearMaskPass extends Pass {

	constructor();

}
