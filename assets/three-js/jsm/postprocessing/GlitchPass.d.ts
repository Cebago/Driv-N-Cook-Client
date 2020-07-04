import {DataTexture, ShaderMaterial} from '../../../src/Three';

import {Pass} from './Pass';

export class GlitchPass extends Pass {

	uniforms: object;
	material: ShaderMaterial;
	fsQuad: object;
	goWild: boolean;
	curF: number;
	randX: number;

	constructor(dt_size?: number);

	generateTrigger(): void;

	generateHeightmap(dt_size: number): DataTexture;

}
