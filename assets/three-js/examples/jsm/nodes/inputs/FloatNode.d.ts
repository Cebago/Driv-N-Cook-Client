import {InputNode} from '../core/InputNode';
import {NodeBuilder} from '../core/NodeBuilder';

export class FloatNode extends InputNode {

	value: number;
	nodeType: string;

	constructor(value?: number);

	generateReadonly(builder: NodeBuilder, output: string, uuid?: string, type?: string, ns?: string, needsUpdate?: boolean): string;

	copy(source: FloatNode): this;

}
