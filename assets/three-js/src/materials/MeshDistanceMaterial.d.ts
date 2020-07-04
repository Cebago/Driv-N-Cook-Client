import {Material, MaterialParameters} from './Material';
import {Vector3} from './../math/Vector3';
import {Texture} from './../textures/Texture';

export interface MeshDistanceMaterialParameters extends MaterialParameters {
	map?: Texture | null;
	alphaMap?: Texture | null;
	displacementMap?: Texture | null;
	displacementScale?: number;
	displacementBias?: number;
	farDistance?: number;
	nearDistance?: number;
	referencePosition?: Vector3;
}

export class MeshDistanceMaterial extends Material {

	map: Texture | null;
	alphaMap: Texture | null;
	displacementMap: Texture | null;
	displacementScale: number;
	displacementBias: number;
	farDistance: number;
	nearDistance: number;
	referencePosition: Vector3;

	constructor(parameters?: MeshDistanceMaterialParameters);

	setValues(parameters: MeshDistanceMaterialParameters): void;

}
