import {Geometry} from './../core/Geometry';
import {BufferGeometry} from './../core/BufferGeometry';

export class PlaneBufferGeometry extends BufferGeometry {

	parameters: {
		width: number;
		height: number;
		widthSegments: number;
		heightSegments: number;
	};

	constructor(
		width?: number,
		height?: number,
		widthSegments?: number,
		heightSegments?: number
	);

}

export class PlaneGeometry extends Geometry {

	parameters: {
		width: number;
		height: number;
		widthSegments: number;
		heightSegments: number;
	};

	constructor(
		width?: number,
		height?: number,
		widthSegments?: number,
		heightSegments?: number
	);

}
