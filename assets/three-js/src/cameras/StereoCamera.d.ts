import {PerspectiveCamera} from './PerspectiveCamera';
import {Camera} from './Camera';

export class StereoCamera extends Camera {

	type: 'StereoCamera';
	aspect: number;
	eyeSep: number;
	cameraL: PerspectiveCamera;
	cameraR: PerspectiveCamera;

	constructor();

	update(camera: PerspectiveCamera): void;

}
