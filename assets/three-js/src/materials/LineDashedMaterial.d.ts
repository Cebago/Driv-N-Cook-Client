import {LineBasicMaterial, LineBasicMaterialParameters} from './LineBasicMaterial';

export interface LineDashedMaterialParameters extends LineBasicMaterialParameters {
	scale?: number;
	dashSize?: number;
	gapSize?: number;
}

export class LineDashedMaterial extends LineBasicMaterial {

	scale: number;
	dashSize: number;
	gapSize: number;
	readonly isLineDashedMaterial: true;

	constructor(parameters?: LineDashedMaterialParameters);

	setValues(parameters: LineDashedMaterialParameters): void;

}
