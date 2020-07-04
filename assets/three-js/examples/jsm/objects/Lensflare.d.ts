import {Color, Mesh, Texture} from '../../../src/Three';

export class LensflareElement {

	texture: Texture;
	size: number;
	distance: number;
	color: Color;

	constructor(texture: Texture, size?: number, distance?: number, color?: Color);

}

export class Lensflare extends Mesh {

	readonly isLensflare: true;

	constructor();

	addElement(element: LensflareElement): void;

	dispose(): void;

}
