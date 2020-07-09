import {Material} from '../../../src/Three';

import {Pass} from './Pass';

export class ShaderPass extends Pass {

	textureID: string;
	uniforms: object;
	material: Material;
	fsQuad: object;

	constructor(shader: object, textureID?: string);

}
