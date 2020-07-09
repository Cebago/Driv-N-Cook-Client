import {ShaderMaterial} from '../../../src/Three';

import {Pass} from './Pass';

export class FilmPass extends Pass {

	uniforms: object;
	material: ShaderMaterial;
	fsQuad: object;

	constructor(noiseIntensity?: number, scanlinesIntensity?: number, scanlinesCount?: number, grayscale?: number);

}
