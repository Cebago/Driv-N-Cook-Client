import {Vector3} from './../math/Vector3';
import {Line} from './../objects/Line';
import {Mesh} from './../objects/Mesh';
import {Color} from './../math/Color';
import {Object3D} from './../core/Object3D';

// Extras / Helpers /////////////////////////////////////////////////////////////////////

export class ArrowHelper extends Object3D {

	line: Line;
	cone: Mesh;

	constructor(
		dir: Vector3,
		origin?: Vector3,
		length?: number,
		color?: number,
		headLength?: number,
		headWidth?: number
	);

	setDirection(dir: Vector3): void;

	setLength(length: number, headLength?: number, headWidth?: number): void;

	setColor(color: Color | string | number): void;

}
