import {Group, Loader, LoadingManager} from '../../../src/Three';
import {MTLLoader} from './MTLLoader';

export class OBJLoader extends Loader {

	materials: MTLLoader.MaterialCreator;

	constructor(manager?: LoadingManager);

	load(url: string, onLoad: (group: Group) => void, onProgress?: (event: ProgressEvent) => void, onError?: (event: ErrorEvent) => void): void;

	parse(data: string): Group;

	setMaterials(materials: MTLLoader.MaterialCreator): this;

}
