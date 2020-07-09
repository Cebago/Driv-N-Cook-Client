import {Vector3} from './../math/Vector3';
import {Geometry} from './../core/Geometry';
import {BufferGeometry} from './../core/BufferGeometry';

export class ParametricBufferGeometry extends BufferGeometry {

	parameters: {
		func: (u: number, v: number, dest: Vector3) => void;
		slices: number;
		stacks: number;
	};

	constructor(
		func: (u: number, v: number, dest: Vector3) => void,
		slices: number,
		stacks: number
	);

}

export class ParametricGeometry extends Geometry {

	parameters: {
		func: (u: number, v: number, dest: Vector3) => void;
		slices: number;
		stacks: number;
	};

	constructor(
		func: (u: number, v: number, dest: Vector3) => void,
		slices: number,
		stacks: number
	);

}
