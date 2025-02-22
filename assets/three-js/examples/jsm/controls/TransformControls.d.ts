import {Camera, MOUSE, Object3D} from '../../../src/Three';

export class TransformControls extends Object3D {

	domElement: HTMLElement;
	camera: Camera;

	// API
	object: Object3D | undefined;
	enabled: boolean;
	axis: string | null;
	mode: string;
	translationSnap: number | null;
	rotationSnap: number | null;
	space: string;
	size: number;
	dragging: boolean;
	showX: boolean;
	showY: boolean;
	showZ: boolean;
	readonly isTransformControls: true;
	mouseButtons: {
		LEFT: MOUSE;
		MIDDLE: MOUSE;
		RIGHT: MOUSE;
	};

	constructor(object: Camera, domElement?: HTMLElement);

	attach(object: Object3D): this;

	detach(): this;

	getMode(): string;

	setMode(mode: string): void;

	setTranslationSnap(translationSnap: Number | null): void;

	setRotationSnap(rotationSnap: Number | null): void;

	setSize(size: number): void;

	setSpace(space: string): void;

	dispose(): void;

}
