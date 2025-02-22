import {Material} from '../../../../../src/Three';

export class MaterialHandler {

	logging: {
		enabled: boolean;
		debug: boolean;
	};
	callbacks: {
		onLoadMaterials: Function;
	};
	materials: object;

	constructor();

	createDefaultMaterials(overrideExisting: boolean): void;

	addMaterials(materials: object, overrideExisting: boolean, newMaterials?: object): object;

	addPayloadMaterials(materialPayload: object): object;

	setLogging(enabled: boolean, debug: boolean): void;

	getMaterials(): object;

	getMaterial(materialName: string): Material;

	getMaterialsJSON(): object;

	clearMaterials(): void;

}
