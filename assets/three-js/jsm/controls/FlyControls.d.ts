import {Camera} from '../../../src/Three';

export class FlyControls {

	object: Camera;
	domElement: HTMLElement | HTMLDocument;
	movementSpeed: number;
	rollSpeed: number;
	dragToLook: boolean;
	autoForward: boolean;

	constructor(object: Camera, domElement?: HTMLElement);

	update(delta: number): void;

	dispose(): void;

}
