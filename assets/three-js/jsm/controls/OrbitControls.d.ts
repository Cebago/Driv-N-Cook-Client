import {Camera, MOUSE, TOUCH, Vector3} from '../../../src/Three';

export class OrbitControls {

	object: Camera;
	domElement: HTMLElement | HTMLDocument;
	// API
	enabled: boolean;
	target: Vector3;
	// deprecated
	center: Vector3;
	minDistance: number;
	maxDistance: number;
	minZoom: number;
	maxZoom: number;
	minPolarAngle: number;
	maxPolarAngle: number;
	minAzimuthAngle: number;
	maxAzimuthAngle: number;
	enableDamping: boolean;
	dampingFactor: number;
	enableZoom: boolean;
	zoomSpeed: number;
	enableRotate: boolean;
	rotateSpeed: number;
	enablePan: boolean;
	panSpeed: number;
	screenSpacePanning: boolean;
	keyPanSpeed: number;
	autoRotate: boolean;
	autoRotateSpeed: number;
	enableKeys: boolean;
	keys: { LEFT: number; UP: number; RIGHT: number; BOTTOM: number; };
	mouseButtons: { LEFT: MOUSE; MIDDLE: MOUSE; RIGHT: MOUSE; };
	touches: { ONE: TOUCH; TWO: TOUCH };

	constructor(object: Camera, domElement?: HTMLElement);

	update(): boolean;

	saveState(): void;

	reset(): void;

	dispose(): void;

	getPolarAngle(): number;

	getAzimuthalAngle(): number;

	// EventDispatcher mixins
	addEventListener(type: string, listener: (event: any) => void): void;

	hasEventListener(type: string, listener: (event: any) => void): boolean;

	removeEventListener(type: string, listener: (event: any) => void): void;

	dispatchEvent(event: { type: string; target: any; }): void;

}

export class MapControls extends OrbitControls {

	constructor(object: Camera, domElement?: HTMLElement);

}
