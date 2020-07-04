import {Geometry} from './../core/Geometry';
import {Material} from './../materials/Material';
import {Raycaster} from './../core/Raycaster';
import {Object3D} from './../core/Object3D';
import {BufferGeometry} from '../core/BufferGeometry';
import {Intersection} from '../core/Raycaster';

export class Line extends Object3D {

	geometry: Geometry | BufferGeometry;
	material: Material | Material[];
	type: 'Line' | 'LineLoop' | 'LineSegments';
	readonly isLine: true;

	constructor(
		geometry?: Geometry | BufferGeometry,
		material?: Material | Material[],
		mode?: number
	);

	computeLineDistances(): this;

	raycast(raycaster: Raycaster, intersects: Intersection[]): void;

}
