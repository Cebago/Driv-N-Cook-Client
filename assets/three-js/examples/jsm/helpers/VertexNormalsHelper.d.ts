import {LineSegments, Object3D} from '../../../src/Three';

export class VertexNormalsHelper extends LineSegments {

	object: Object3D;
	size: number;

	constructor(
		object: Object3D,
		size?: number,
		hex?: number
	);

	update(): void;

}
