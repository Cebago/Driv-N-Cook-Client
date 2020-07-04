import {ShaderMaterial,} from '../../../src/Three';

import {Pass} from './Pass';

export interface HalftonePassParameters {
	shape?: number;
	radius?: number;
	rotateR?: number;
	rotateB?: number;
	rotateG?: number;
	scatter?: number;
	blending?: number;
	blendingMode?: number;
	greyscale?: boolean;
	disable?: boolean;
}

export class HalftonePass extends Pass {

	uniforms: object;
	material: ShaderMaterial;
	fsQuad: object;

	constructor(width: number, height: number, params: HalftonePassParameters);

}
