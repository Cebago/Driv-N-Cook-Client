import {Matrix3, Mesh,} from '../../../src/Three';

import {Volume} from './Volume';

export class VolumeSlice {

	index: number;
	axis: string;
	canvas: HTMLCanvasElement;
	canvasBuffer: HTMLCanvasElement;
	ctx: CanvasRenderingContext2D;
	ctxBuffer: CanvasRenderingContext2D;
	mesh: Mesh;
	geometryNeedsUpdate: boolean;
	sliceAccess: number;
	jLength: number;
	iLength: number;
	matrix: Matrix3;

	constructor(volume: Volume, index?: number, axis?: string);

	repaint(): void;

	updateGeometry(): void;

}
