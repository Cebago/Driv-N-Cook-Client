import {ShaderMaterial, Texture} from '../../../src/Three';

import {Pass} from './Pass';

export class TexturePass extends Pass {

	map: Texture;
	opacity: number;
	uniforms: object;
	material: ShaderMaterial;
	fsQuad: object;

	constructor(map: Texture, opacity?: number);

}
