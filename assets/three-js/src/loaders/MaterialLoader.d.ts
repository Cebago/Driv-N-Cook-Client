import {Loader} from './Loader';
import {LoadingManager} from './LoadingManager';
import {Texture} from './../textures/Texture';
import {Material} from './../materials/Material';

export class MaterialLoader extends Loader {

	textures: { [key: string]: Texture };

	constructor(manager?: LoadingManager);

	load(
		url: string,
		onLoad: (material: Material) => void,
		onProgress?: (event: ProgressEvent) => void,
		onError?: (event: Error | ErrorEvent) => void
	): void;

	setTextures(textures: { [key: string]: Texture }): this;

	parse(json: any): Material;

}
