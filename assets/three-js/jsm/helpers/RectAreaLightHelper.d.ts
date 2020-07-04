import {Color, Line, RectAreaLight} from '../../../src/Three';

export class RectAreaLightHelper extends Line {

	light: RectAreaLight;
	color: Color | string | number | undefined;

	constructor(light: RectAreaLight, color?: Color | string | number);

	update(): void;

	dispose(): void;

}
