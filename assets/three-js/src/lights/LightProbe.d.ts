import {SphericalHarmonics3} from './../math/SphericalHarmonics3';
import {Light} from './Light';

export class LightProbe extends Light {

	readonly isLightProbe: true;
	sh: SphericalHarmonics3;

	constructor(sh?: SphericalHarmonics3, intensity?: number);

	fromJSON(json: object): LightProbe;

}
