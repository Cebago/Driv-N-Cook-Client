import {Material, MaterialParameters} from './Material';
import {Color} from './../math/Color';
import {Texture} from './../textures/Texture';

export interface PointsMaterialParameters extends MaterialParameters {
	color?: Color | string | number;
	map?: Texture | null;
	alphaMap?: Texture | null;
	size?: number;
	sizeAttenuation?: boolean;
	morphTargets?: boolean;
}

export class PointsMaterial extends Material {

	color: Color;
	map: Texture | null;
	alphaMap: Texture | null;
	size: number;
	sizeAttenuation: boolean;
	morphTargets: boolean;

	constructor(parameters?: PointsMaterialParameters);

	setValues(parameters: PointsMaterialParameters): void;

}
