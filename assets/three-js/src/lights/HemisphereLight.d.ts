import {Color} from './../math/Color';
import {Light} from './Light';

export class HemisphereLight extends Light {

	skyColor: Color;
	groundColor: Color;
	intensity: number;
	readonly isHemisphereLight: true;

	constructor(
		skyColor?: Color | string | number,
		groundColor?: Color | string | number,
		intensity?: number
	);

}
