import {Curve} from './../core/Curve';
import {Vector2} from '../../math/Vector2';

export class EllipseCurve extends Curve<Vector2> {

	aX: number;
	aY: number;
	xRadius: number;
	yRadius: number;
	aStartAngle: number;
	aEndAngle: number;
	aClockwise: boolean;
	aRotation: number;

	constructor(
		aX: number,
		aY: number,
		xRadius: number,
		yRadius: number,
		aStartAngle: number,
		aEndAngle: number,
		aClockwise: boolean,
		aRotation: number
	);

}
