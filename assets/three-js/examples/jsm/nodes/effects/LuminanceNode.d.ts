import {TempNode} from '../core/TempNode';
import {FunctionNode} from '../core/FunctionNode';
import {ConstNode} from '../core/ConstNode';
import {Node} from '../core/Node';

export class LuminanceNode extends TempNode {

	static Nodes: {
		LUMA: ConstNode;
		luminance: FunctionNode;
	}
	rgb: Node;
	nodeType: string;

	constructor(rgb: Node);

	copy(source: LuminanceNode): this;

}
