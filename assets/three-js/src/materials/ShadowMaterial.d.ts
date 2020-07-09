import {Color} from './../math/Color';
import {Material, MaterialParameters} from './Material';

export interface ShadowMaterialParameters extends MaterialParameters {
	color?: Color | string | number;
}

export class ShadowMaterial extends Material {

	color: Color;

	constructor(parameters?: ShadowMaterialParameters);

}
