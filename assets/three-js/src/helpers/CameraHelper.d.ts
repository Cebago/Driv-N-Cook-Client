import {Camera} from './../cameras/Camera';
import {LineSegments} from './../objects/LineSegments';

export class CameraHelper extends LineSegments {

	camera: Camera;
	pointMap: { [id: string]: number[] };

	constructor(camera: Camera);

	update(): void;

}
