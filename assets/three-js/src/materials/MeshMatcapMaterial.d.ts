import {Color} from './../math/Color';
import {Texture} from './../textures/Texture';
import {Vector2} from './../math/Vector2';
import {Material, MaterialParameters} from './Material';
import {NormalMapTypes} from '../constants';

export interface MeshMatcapMaterialParameters extends MaterialParameters {

	color?: Color | string | number;
	matcap?: Texture | null;
	map?: Texture | null;
	bumpMap?: Texture | null;
	bumpScale?: number;
	normalMap?: Texture | null;
	normalMapType?: NormalMapTypes;
	normalScale?: Vector2;
	displacementMap?: Texture | null;
	displacementScale?: number;
	displacementBias?: number;
	alphaMap?: Texture | null;
	skinning?: boolean;
	morphTargets?: boolean;
	morphNormals?: boolean;
}

export class MeshMatcapMaterial extends Material {

	color: Color;
	matcap: Texture | null;
	map: Texture | null;
	bumpMap: Texture | null;
	bumpScale: number;
	normalMap: Texture | null;
	normalMapType: NormalMapTypes;
	normalScale: Vector2;
	displacementMap: Texture | null;
	displacementScale: number;
	displacementBias: number;
	alphaMap: Texture | null;
	skinning: boolean;
	morphTargets: boolean;
	morphNormals: boolean;

	constructor(parameters?: MeshMatcapMaterialParameters);

	setValues(parameters: MeshMatcapMaterialParameters): void;

}
