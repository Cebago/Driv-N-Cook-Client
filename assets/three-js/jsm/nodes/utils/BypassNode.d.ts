import {Node} from '../core/Node';

export class BypassNode extends Node {

	code: Node;
	value: Node | undefined;
	nodeType: string;

	constructor(code: Node, value?: Node);

	copy(source: BypassNode): this;

}
