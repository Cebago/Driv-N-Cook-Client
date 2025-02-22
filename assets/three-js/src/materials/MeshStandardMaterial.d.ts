import {Color} from './../math/Color';
import {Texture} from './../textures/Texture';
import {Vector2} from './../math/Vector2';
import {Material, MaterialParameters} from './Material';
import {NormalMapTypes} from '../constants';

export interface MeshStandardMaterialParameters extends MaterialParameters {
	color?: Color | string | number;
	roughness?: number;
	metalness?: number;
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
	roughnessMap?: Texture | null;
	metalnessMap?: Texture | null;
	alphaMap?: Texture | null;
	envMap?: Texture | null;
	envMapIntensity?: number;
	refractionRatio?: number;
	wireframe?: boolean;
	wireframeLinewidth?: number;
	skinning?: boolean;
	vertexTangents?: boolean;
	morphTargets?: boolean;
	morphNormals?: boolean;
}

export class MeshStandardMaterial extends Material {

	color: Color;
	roughness: number;
	metalness: number;
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
	roughnessMap: Texture | null;
	metalnessMap: Texture | null;
	alphaMap: Texture | null;
	envMap: Texture | null;
	envMapIntensity: number;
	refractionRatio: number;
	wireframe: boolean;
	wireframeLinewidth: number;
	skinning: boolean;
	vertexTangents: boolean;
	morphTargets: boolean;
	morphNormals: boolean;

	constructor(parameters?: MeshStandardMaterialParameters);

	setValues(parameters: MeshStandardMaterialParameters): void;

}
