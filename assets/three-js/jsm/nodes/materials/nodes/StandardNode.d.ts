import {NodeBuilder} from '../../core/NodeBuilder';
import {Node} from '../../core/Node';

export class StandardNode extends Node {

	color: Node;
	roughness: Node;
	metalness: Node;
	nodeType: string;

	constructor();

	build(builder: NodeBuilder): string;

	copy(source: StandardNode): this;

}
