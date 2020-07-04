import {Geometry} from './../core/Geometry';
import {BufferGeometry} from '../core/BufferGeometry';
import {Material} from './../materials/Material';
import {BufferAttribute} from './../core/BufferAttribute';
import {Mesh} from './Mesh';
import {Matrix4} from './../math/Matrix4';

export class InstancedMesh extends Mesh {

	count: number;
	instanceMatrix: BufferAttribute;
	readonly isInstancedMesh: true;

	constructor(
		geometry: Geometry | BufferGeometry,
		material: Material | Material[],
		count: number
	);

	getMatrixAt(index: number, matrix: Matrix4): void;

	setMatrixAt(index: number, matrix: Matrix4): void;


}
