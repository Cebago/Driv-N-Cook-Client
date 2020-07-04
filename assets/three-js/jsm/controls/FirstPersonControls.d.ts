import {Camera, Vector3} from '../../../src/Three';

export class FirstPersonControls {

	object: Camera;
	domElement: HTMLElement | HTMLDocument;
	enabled: boolean;
	movementSpeed: number;
	lookSpeed: number;
	lookVertical: boolean;
	autoForward: boolean;
	activeLook: boolean;
	heightSpeed: boolean;
	heightCoef: number;
	heightMin: number;
	heightMax: number;
	constrainVertical: boolean;
	verticalMin: number;
	verticalMax: number;
	mouseDragOn: boolean;

	constructor(object: Camera, domElement?: HTMLElement);

	handleResize(): void;

	lookAt(x: number | Vector3, y: number, z: number): this;

	update(delta: number): this;

	dispose(): void;

}
