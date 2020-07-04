import {TempNode} from '../core/TempNode';
import {Node} from '../core/Node';

export class OperatorNode extends TempNode {

	static ADD: string;
	static SUB: string;
	static MUL: string;
	static DIV: string;
	a: Node;
	b: Node;
	op: string;

	constructor(a: Node, b: Node, op: string);

	copy(source: OperatorNode): this;

}
