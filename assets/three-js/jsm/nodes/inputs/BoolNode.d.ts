import {InputNode} from '../core/InputNode';
import {NodeBuilder} from '../core/NodeBuilder';

export class BoolNode extends InputNode {

	value: boolean;
	nodeType: string;

	constructor(value?: boolean);

	generateReadonly(builder: NodeBuilder, output: string, uuid?: string, type?: string, ns?: string, needsUpdate?: boolean): string;

	copy(source: BoolNode): this;

}
