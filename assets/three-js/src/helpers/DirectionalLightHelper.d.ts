import {DirectionalLight} from './../lights/DirectionalLight';
import {Color} from './../math/Color';
import {Line} from './../objects/Line';
import {Matrix4} from './../math/Matrix4';
import {Object3D} from './../core/Object3D';

export class DirectionalLightHelper extends Object3D {

	light: DirectionalLight;
	lightPlane: Line;
	targetLine: Line;
	color: Color | string | number | undefined;
	matrix: Matrix4;
	matrixAutoUpdate: boolean;

	constructor(
		light: DirectionalLight,
		size?: number,
		color?: Color | string | number
	);

	dispose(): void;

	update(): void;

}
