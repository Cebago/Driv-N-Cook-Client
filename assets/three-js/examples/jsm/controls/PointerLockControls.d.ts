import {Camera, EventDispatcher, Vector3} from '../../../src/Three';

export class PointerLockControls extends EventDispatcher {

	domElement: HTMLElement;
	isLocked: boolean;

	// API

	constructor(camera: Camera, domElement?: HTMLElement);

	connect(): void;

	disconnect(): void;

	dispose(): void;

	getObject(): Camera;

	getDirection(v: Vector3): Vector3;

	moveForward(distance: number): void;

	moveRight(distance: number): void;

	lock(): void;

	unlock(): void;

}
