import {NodeBuilder} from '../../core/NodeBuilder';
import {Node} from '../../core/Node';

export class PhongNode extends Node {

	color: Node;
	specular: Node;
	shininess: Node;
	nodeType: string;

	constructor();

	build(builder: NodeBuilder): string;

	copy(source: PhongNode): this;

}
