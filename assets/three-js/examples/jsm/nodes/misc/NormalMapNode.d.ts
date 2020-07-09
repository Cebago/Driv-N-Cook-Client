import {TempNode} from '../core/TempNode';
import {FunctionNode} from '../core/FunctionNode';
import {TextureNode} from '../inputs/TextureNode';
import {Vector2Node} from '../inputs/Vector2Node';

export class NormalMapNode extends TempNode {

	static Nodes: {
		perturbNormal2Arb: FunctionNode;
	}
	value: TextureNode;
	scale: Vector2Node;
	toNormalMap: boolean;
	nodeType: string;

	constructor(value: TextureNode, scale?: Vector2Node);

	copy(source: NormalMapNode): this;

}
