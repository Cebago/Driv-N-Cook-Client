import {Color} from './../math/Color';
import {LightProbe} from './LightProbe';

export class AmbientLightProbe extends LightProbe {

	readonly isAmbientLightProbe: true;

	constructor(color?: Color | string | number, intensity?: number);

}
