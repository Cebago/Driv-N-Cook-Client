import {Camera, Color, Object3D, Scene} from '../../../src/Three';

export class SVGObject extends Object3D {

	node: SVGElement;

	constructor(node: SVGElement);

}

export class SVGRenderer {

	domElement: SVGElement;
	autoClear: boolean;
	sortObjects: boolean;
	sortElements: boolean;
	overdraw: number;
	info: { render: { vertices: number, faces: number } };

	constructor();

	setQuality(quality: string): void;

	setClearColor(color: Color, alpha: number): void;

	setPixelRatio(): void;

	setSize(width: number, height: number): void;

	setPrecision(precision: number): void;

	clear(): void;

	render(scene: Scene, camera: Camera): void;

}
