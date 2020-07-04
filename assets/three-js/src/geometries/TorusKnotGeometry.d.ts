import {Geometry} from './../core/Geometry';
import {BufferGeometry} from './../core/BufferGeometry';

export class TorusKnotBufferGeometry extends BufferGeometry {

	parameters: {
		radius: number;
		tube: number;
		tubularSegments: number;
		radialSegments: number;
		p: number;
		q: number;
		heightScale: number;
	};

	constructor(
		radius?: number,
		tube?: number,
		tubularSegments?: number,
		radialSegments?: number,
		p?: number,
		q?: number
	);

}

export class TorusKnotGeometry extends Geometry {

	parameters: {
		radius: number;
		tube: number;
		tubularSegments: number;
		radialSegments: number;
		p: number;
		q: number;
		heightScale: number;
	};

	constructor(
		radius?: number,
		tube?: number,
		tubularSegments?: number,
		radialSegments?: number,
		p?: number,
		q?: number
	);

}
