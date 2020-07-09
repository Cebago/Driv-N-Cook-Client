import {TempNode} from '../core/TempNode';

export class JoinNode extends TempNode {

	x: Node;
	y: Node;
	z: Node | undefined;
	w: Node | undefined;
	nodeType: string;

	constructor(x: Node, y: Node, z?: Node, w?: Node);

	getNumElements(): number;

	copy(source: JoinNode): this;

}
