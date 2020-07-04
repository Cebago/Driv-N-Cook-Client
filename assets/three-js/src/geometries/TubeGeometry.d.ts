import {Curve} from './../extras/core/Curve';
import {Vector3} from './../math/Vector3';
import {Geometry} from './../core/Geometry';
import {BufferGeometry} from './../core/BufferGeometry';

export class TubeBufferGeometry extends BufferGeometry {

	parameters: {
		path: Curve<Vector3>;
		tubularSegments: number;
		radius: number;
		radialSegments: number;
		closed: boolean;
	};
	tangents: Vector3[];
	normals: Vector3[];
	binormals: Vector3[];

	constructor(
		path: Curve<Vector3>,
		tubularSegments?: number,
		radius?: number,
		radiusSegments?: number,
		closed?: boolean
	);

}

export class TubeGeometry extends Geometry {

	parameters: {
		path: Curve<Vector3>;
		tubularSegments: number;
		radius: number;
		radialSegments: number;
		closed: boolean;
	};
	tangents: Vector3[];
	normals: Vector3[];
	binormals: Vector3[];

	constructor(
		path: Curve<Vector3>,
		tubularSegments?: number,
		radius?: number,
		radiusSegments?: number,
		closed?: boolean
	);

}
