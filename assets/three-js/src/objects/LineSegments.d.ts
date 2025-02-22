import {Geometry} from './../core/Geometry';
import {Material} from './../materials/Material';
import {Line} from './Line';
import {BufferGeometry} from '../core/BufferGeometry';

/**
 * @deprecated
 */
export const LineStrip: number;
/**
 * @deprecated
 */
export const LinePieces: number;

export class LineSegments extends Line {

	type: 'LineSegments';
	readonly isLineSegments: true;

	constructor(
		geometry?: Geometry | BufferGeometry,
		material?: Material | Material[],
		mode?: number
	);

}
