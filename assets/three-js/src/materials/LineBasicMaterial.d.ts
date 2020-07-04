import {Color} from './../math/Color';
import {Material, MaterialParameters} from './Material';

export interface LineBasicMaterialParameters extends MaterialParameters {
	color?: Color | string | number;
	linewidth?: number;
	linecap?: string;
	linejoin?: string;
}

export class LineBasicMaterial extends Material {

	color: Color;
	linewidth: number;
	linecap: string;
	linejoin: string;

	constructor(parameters?: LineBasicMaterialParameters);

	setValues(parameters: LineBasicMaterialParameters): void;

}
