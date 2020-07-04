import {Color} from './../math/Color';
import {Texture} from './../textures/Texture';
import {Material, MaterialParameters} from './Material';
import {Combine} from '../constants';

/**
 * parameters is an object with one or more properties defining the material's appearance.
 */
export interface MeshBasicMaterialParameters extends MaterialParameters {
	color?: Color | string | number;
	opacity?: number;
	map?: Texture | null;
	aoMap?: Texture | null;
	aoMapIntensity?: number;
	specularMap?: Texture | null;
	alphaMap?: Texture | null;
	envMap?: Texture | null;
	combine?: Combine;
	reflectivity?: number;
	refractionRatio?: number;
	wireframe?: boolean;
	wireframeLinewidth?: number;
	wireframeLinecap?: string;
	wireframeLinejoin?: string;
	skinning?: boolean;
	morphTargets?: boolean;
}

export class MeshBasicMaterial extends Material {

	color: Color;
	map: Texture | null;
	aoMap: Texture | null;
	aoMapIntensity: number;
	specularMap: Texture | null;
	alphaMap: Texture | null;
	envMap: Texture | null;
	combine: Combine;
	reflectivity: number;
	refractionRatio: number;
	wireframe: boolean;
	wireframeLinewidth: number;
	wireframeLinecap: string;
	wireframeLinejoin: string;
	skinning: boolean;
	morphTargets: boolean;

	constructor(parameters?: MeshBasicMaterialParameters);

	setValues(parameters: MeshBasicMaterialParameters): void;

}
