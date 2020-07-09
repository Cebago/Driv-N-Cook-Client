import {Color} from './../math/Color';
import {LightProbe} from './LightProbe';

export class HemisphereLightProbe extends LightProbe {

	readonly isHemisphereLightProbe: true;

	constructor(skyColor?: Color | string | number, groundColor?: Color | string | number, intensity?: number);

}
