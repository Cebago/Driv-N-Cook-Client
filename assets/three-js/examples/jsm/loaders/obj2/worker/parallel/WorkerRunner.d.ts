export class ObjectManipulator {

	constructor();

	applyProperties(objToAlter: object, params: object, forceCreation: boolean): void;

}

export class DefaultWorkerPayloadHandler {

	logging: {
		enabled: boolean;
		debug: boolean;
	};
	parser: object;

	constructor(parser: object);

	handlePayload(payload: object): void;

}

export class WorkerRunner {

	payloadHandler: object;

	constructor(payloadHandler: object);

	processMessage(payload: object): void;

}
