import {DepthPackingStrategies} from '../constants';
import {Material, MaterialParameters} from './Material';
import {Texture} from './../textures/Texture';

export interface MeshDepthMaterialParameters extends MaterialParameters {
	map?: Texture | null;
	alphaMap?: Texture | null;
	depthPacking?: DepthPackingStrategies;
	displacementMap?: Texture | null;
	displacementScale?: number;
	displacementBias?: number;
	wireframe?: boolean;
	wireframeLinewidth?: number;
}

export class MeshDepthMaterial extends Material {

	map: Texture | null;
	alphaMap: Texture | null;
	depthPacking: DepthPackingStrategies;
	displacementMap: Texture | null;
	displacementScale: number;
	displacementBias: number;
	wireframe: boolean;
	wireframeLinewidth: number;

	constructor(parameters?: MeshDepthMaterialParameters);

	setValues(parameters: MeshDepthMaterialParameters): void;

}
