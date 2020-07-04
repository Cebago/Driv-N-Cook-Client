import {Scene} from '../../scenes/Scene';
import {Camera} from '../../cameras/Camera';
import {Light} from '../../lights/Light';
import {WebGLLights} from './WebGLLights';

interface WebGLRenderState {

	state: {
		lightsArray: Light[];
		shadowsArray: Light[];
		lights: WebGLLights;
	};

	init(): void;

	setupLights(camera: Camera): void;

	pushLight(light: Light): void;

	pushShadow(shadowLight: Light): void;

}

export class WebGLRenderStates {

	get(scene: Scene, camera: Camera): WebGLRenderState;

	dispose(): void;

}
