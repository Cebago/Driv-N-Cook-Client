import {Geometry} from '../../../src/Three';

export class TessellateModifier {

	maxEdgeLength: number;

	constructor(maxEdgeLength: number);

	modify(geometry: Geometry): void;

}
