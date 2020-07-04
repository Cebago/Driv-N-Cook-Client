import {Geometry} from './../core/Geometry';
import {PolyhedronBufferGeometry} from './PolyhedronGeometry';

export class DodecahedronBufferGeometry extends PolyhedronBufferGeometry {

	constructor(radius?: number, detail?: number);

}

export class DodecahedronGeometry extends Geometry {

	parameters: {
		radius: number;
		detail: number;
	};

	constructor(radius?: number, detail?: number);

}
