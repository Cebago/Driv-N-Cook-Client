import {Geometry} from './../core/Geometry';
import {BufferGeometry} from './../core/BufferGeometry';

export class TorusBufferGeometry extends BufferGeometry {

	parameters: {
		radius: number;
		tube: number;
		radialSegments: number;
		tubularSegments: number;
		arc: number;
	};

	constructor(
		radius?: number,
		tube?: number,
		radialSegments?: number,
		tubularSegments?: number,
		arc?: number
	);

}

export class TorusGeometry extends Geometry {

	parameters: {
		radius: number;
		tube: number;
		radialSegments: number;
		tubularSegments: number;
		arc: number;
	};

	constructor(
		radius?: number,
		tube?: number,
		radialSegments?: number,
		tubularSegments?: number,
		arc?: number
	);

}
