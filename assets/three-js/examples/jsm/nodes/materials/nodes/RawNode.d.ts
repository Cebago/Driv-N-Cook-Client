import {Node} from '../../core/Node';

export class RawNode extends Node {

	value: Node;
	nodeType: string;

	constructor(value: Node);

	copy(source: RawNode): this;

}
