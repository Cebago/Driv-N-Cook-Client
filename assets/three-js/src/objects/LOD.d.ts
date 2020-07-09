import {Object3D} from './../core/Object3D';
import {Raycaster} from './../core/Raycaster';
import {Camera} from './../cameras/Camera';
import {Intersection} from '../core/Raycaster';

export class LOD extends Object3D {

	type: 'LOD';
	levels: { distance: number; object: Object3D }[];
	autoUpdate: boolean;
	readonly isLOD: true;
	/**
	 * @deprecated Use {@link LOD#levels .levels} instead.
	 */
	objects: any[];

	constructor();

	addLevel(object: Object3D, distance?: number): this;

	getCurrentLevel(): number;

	getObjectForDistance(distance: number): Object3D | null;

	raycast(raycaster: Raycaster, intersects: Intersection[]): void;

	update(camera: Camera): void;

	toJSON(meta: any): any;

}
