import {Plane} from './../math/Plane';
import {LineSegments} from './../objects/LineSegments';

export class PlaneHelper extends LineSegments {

	plane: Plane;
	size: number;

	constructor(plane: Plane, size?: number, hex?: number);

	updateMatrixWorld(force?: boolean): void;

}
