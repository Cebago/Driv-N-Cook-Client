import {Line} from '../../../src/Three';

import {LineSegmentsGeometry} from './LineSegmentsGeometry';

export class LineGeometry extends LineSegmentsGeometry {

	readonly isLineGeometry: true;

	constructor();

	fromLine(line: Line): this;

}
