import {Node} from '../core/Node';

export class SwitchNode extends Node {

	node: Node;
	components: string;
	nodeType: string;

	constructor(node: Node, components?: string);

	copy(source: SwitchNode): this;

}
