import {Color} from './../math/Color';
import {IFog} from './Fog';

/**
 * This class contains the parameters that define linear fog, i.e., that grows exponentially denser with the distance.
 */
export class FogExp2 implements IFog {

	name: string;
	color: Color;
	/**
	 * Defines how fast the fog will grow dense.
	 * Default is 0.00025.
	 */
	density: number;
	readonly isFogExp2: true;

	constructor(hex: number | string, density?: number);

	clone(): this;

	toJSON(): any;

}
