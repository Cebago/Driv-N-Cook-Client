import {Color} from './../math/Color';
import {Texture} from './../textures/Texture';
import {Material, MaterialParameters} from './Material';

export interface SpriteMaterialParameters extends MaterialParameters {
	color?: Color | string | number;
	map?: Texture | null;
	alphaMap?: Texture | null;
	rotation?: number;
	sizeAttenuation?: boolean;
}

export class SpriteMaterial extends Material {

	color: Color;
	map: Texture | null;
	alphaMap: Texture | null;
	rotation: number;
	sizeAttenuation: boolean;
	readonly isSpriteMaterial: true;

	constructor(parameters?: SpriteMaterialParameters);

	setValues(parameters: SpriteMaterialParameters): void;

	copy(source: SpriteMaterial): this;

}
