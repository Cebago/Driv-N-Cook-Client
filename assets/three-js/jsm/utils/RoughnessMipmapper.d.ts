import {MeshStandardMaterial, WebGLRenderer} from '../../../src/Three';

export class RoughnessMipmapper {

	constructor(renderer: WebGLRenderer);

	generateMipmaps(material: MeshStandardMaterial): void;

	dispose(): void;

}
