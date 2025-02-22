import {Vector2} from './../../math/Vector2';
import {Curve} from './../core/Curve';

export class CubicBezierCurve extends Curve<Vector2> {

	v0: Vector2;
	v1: Vector2;
	v2: Vector2;
	v3: Vector2;

	constructor(v0: Vector2, v1: Vector2, v2: Vector2, v3: Vector2);

}
