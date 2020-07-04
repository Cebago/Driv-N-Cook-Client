import {BufferGeometry, Geometry} from '../../../src/Three';

export class SubdivisionModifier {

	subdivisions: number;

	constructor(subdivisions?: number);

	modify(geometry: BufferGeometry | Geometry): Geometry;

	smooth(geometry: Geometry): void;

}
