import {Color} from './../math/Color';
import {Texture} from './../textures/Texture';
import {Vector2} from './../math/Vector2';
import {Material, MaterialParameters} from './Material';
import {NormalMapTypes} from '../constants';

export interface MeshToonMaterialParameters extends MaterialParameters {
	/** geometry color in hexadecimal. Default is 0xffffff. */
	color?: Color | string | number;
	specular?: Color | string | number;
	shininess?: number;
	opacity?: number;
	gradientMap?: Texture | null;
	map?: Texture | null;
	lightMap?: Texture | null;
	lightMapIntensity?: number;
	aoMap?: Texture | null;
	aoMapIntensity?: number;
	emissive?: Color | string | number;
	emissiveIntensity?: number;
	emissiveMap?: Texture | null;
	bumpMap?: Texture | null;
	bumpScale?: number;
	normalMap?: Texture | null;
	normalMapType?: NormalMapTypes;
	normalScale?: Vector2;
	displacementMap?: Texture | null;
	displacementScale?: number;
	displacementBias?: number;
	specularMap?: Texture | null;
	alphaMap?: Texture | null;
	wireframe?: boolean;
	wireframeLinewidth?: number;
	wireframeLinecap?: string;
	wireframeLinejoin?: string;
	skinning?: boolean;
	morphTargets?: boolean;
	morphNormals?: boolean;
}

export class MeshToonMaterial extends Material {

	color: Color;
	specular: Color;
	shininess: number;
	gradientMap: Texture | null;
	map: Texture | null;
	lightMap: Texture | null;
	lightMapIntensity: number;
	aoMap: Texture | null;
	aoMapIntensity: number;
	emissive: Color;
	emissiveIntensity: number;
	emissiveMap: Texture | null;
	bumpMap: Texture | null;
	bumpScale: number;
	normalMap: Texture | null;
	normalMapType: NormalMapTypes;
	normalScale: Vector2;
	displacementMap: Texture | null;
	displacementScale: number;
	displacementBias: number;
	specularMap: Texture | null;
	alphaMap: Texture | null;
	wireframe: boolean;
	wireframeLinewidth: number;
	wireframeLinecap: string;
	wireframeLinejoin: string;
	skinning: boolean;
	morphTargets: boolean;
	morphNormals: boolean;

	constructor(parameters?: MeshToonMaterialParameters);

	setValues(parameters: MeshToonMaterialParameters): void;

}
