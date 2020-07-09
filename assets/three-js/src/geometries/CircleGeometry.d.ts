import {Geometry} from './../core/Geometry';
import {BufferGeometry} from '../core/BufferGeometry';

export class CircleBufferGeometry extends BufferGeometry {

	parameters: {
		radius: number;
		segments: number;
		thetaStart: number;
		thetaLength: number;
	};

	constructor(
		radius?: number,
		segments?: number,
		thetaStart?: number,
		thetaLength?: number
	);

}

export class CircleGeometry extends Geometry {

	parameters: {
		radius: number;
		segments: number;
		thetaStart: number;
		thetaLength: number;
	};

	constructor(
		radius?: number,
		segments?: number,
		thetaStart?: number,
		thetaLength?: number
	);

}
