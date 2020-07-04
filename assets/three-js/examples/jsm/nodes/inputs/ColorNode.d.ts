import {Color} from '../../../../src/Three';

import {InputNode} from '../core/InputNode';
import {NodeBuilder} from '../core/NodeBuilder';

export class ColorNode extends InputNode {

	value: Color;
	nodeType: string;

	constructor(color: Color | number | string, g?: number, b?: number);

	generateReadonly(builder: NodeBuilder, output: string, uuid?: string, type?: string, ns?: string, needsUpdate?: boolean): string;

	copy(source: ColorNode): this;

}
