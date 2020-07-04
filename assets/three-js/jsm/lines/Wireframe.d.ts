import {Mesh,} from '../../../src/Three';

import {LineMaterial} from './LineMaterial';
import {LineSegmentsGeometry} from './LineSegmentsGeometry';

export class Wireframe extends Mesh {

	readonly isWireframe: true;

	constructor(geometry?: LineSegmentsGeometry, material?: LineMaterial);

	computeLineDistances(): this;

}
