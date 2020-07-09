import {Camera, Color, Scene} from '../../../src/Three';

import {SSAARenderPass} from './SSAARenderPass';

export class TAARenderPass extends SSAARenderPass {

	accumulate: boolean;

	constructor(scene: Scene, camera: Camera, clearColor: Color | string | number, clearAlpha: number);

}
