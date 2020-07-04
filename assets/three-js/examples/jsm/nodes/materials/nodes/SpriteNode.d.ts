import {NodeBuilder} from '../../core/NodeBuilder';
import {Node} from '../../core/Node';

export class SpriteNode extends Node {

	color: Node;
	spherical: true;
	nodeType: string;

	constructor();

	build(builder: NodeBuilder): string;

	copy(source: SpriteNode): this;

}
