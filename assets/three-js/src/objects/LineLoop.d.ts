import {Line} from './Line';
import {Geometry} from './../core/Geometry';
import {Material} from './../materials/Material';
import {BufferGeometry} from '../core/BufferGeometry';

export class LineLoop extends Line {

	type: 'LineLoop';
	readonly isLineLoop: true;

	constructor(
		geometry?: Geometry | BufferGeometry,
		material?: Material | Material[]
	);

}
