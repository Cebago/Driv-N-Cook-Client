import {Camera, Color, Scene, ShaderMaterial} from '../../../src/Three';

import {Pass} from './Pass';

export class SSAARenderPass extends Pass {

	scene: Scene;
	camera: Camera;
	sampleLevel: number;
	unbiased: boolean;
	clearColor: Color | string | number;
	clearAlpha: number;
	copyUniforms: object;
	copyMaterial: ShaderMaterial;
	fsQuad: object;

	constructor(scene: Scene, camera: Camera, clearColor: Color | string | number, clearAlpha: number);

}
