import {TempNode} from '../core/TempNode';
import {NodeBuilder} from '../core/NodeBuilder';
import {Node} from '../core/Node';

export class CondNode extends TempNode {

	static EQUAL: string;
	static NOT_EQUAL: string;
	static GREATER: string;
	static GREATER_EQUAL: string;
	static LESS: string;
	static LESS_EQUAL: string;
	a: Node;
	b: Node;
	op: string;
	ifNode: Node;
	elseNode: Node;
	nodeType: string;

	constructor(a: Node, b: Node, op: string, ifNode: Node, elseNode: Node);

	getCondType(builder: NodeBuilder): string;

	copy(source: CondNode): this;

}
