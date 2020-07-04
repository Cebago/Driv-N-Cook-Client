import {Mesh} from '../../../../../src/Three';

import {MaterialHandler} from './MaterialHandler';

export class MeshReceiver {

	logging: {
		enabled: boolean;
		debug: boolean;
	};
	callbacks: {
		onParseProgress: Function;
		onMeshAlter: Function;
	};
	materialHandler: MaterialHandler;

	constructor(materialHandler: MaterialHandler);

	buildMeshes(meshPayload: object): Mesh[];

	setLogging(enabled: boolean, debug: boolean): void;

}
