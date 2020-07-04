import {Camera, Scene, WebGLRenderer} from '../../../src/Three';

export class PeppersGhostEffect {

	cameraDistance: number;
	reflectFromAbove: boolean;

	constructor(renderer: WebGLRenderer);

	render(scene: Scene, camera: Camera): void;

	setSize(width: number, height: number): void;

}
