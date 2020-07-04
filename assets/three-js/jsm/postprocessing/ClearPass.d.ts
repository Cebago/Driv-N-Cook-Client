import {Color} from '../../../src/Three';

import {Pass} from './Pass';

export class ClearPass extends Pass {

	clearColor: Color | string | number;
	clearAlpha: number;

	constructor(clearColor?: Color | string | number, clearAlpha?: number);

}
