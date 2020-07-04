import {InputNode} from '../core/InputNode';
import {NodeBuilder} from '../core/NodeBuilder';

export class IntNode extends InputNode {

	value: number;
	nodeType: string;

	constructor(value?: number);

	generateReadonly(builder: NodeBuilder, output: string, uuid?: string, type?: string, ns?: string, needsUpdate?: boolean): string;

	copy(source: IntNode): this;

}
