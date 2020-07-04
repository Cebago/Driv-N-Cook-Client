import {Camera, Matrix3, Scene, WebGLRenderer} from '../../../src/Three';

export class AnaglyphEffect {

	colorMatrixLeft: Matrix3;
	colorMatrixRight: Matrix3;

	constructor(renderer: WebGLRenderer, width?: number, height?: number);

	dispose(): void;

	render(scene: Scene, camera: Camera): void;

	setSize(width: number, height: number): void;

}
