import {TempNode} from '../core/TempNode';
import {FloatNode} from '../inputs/FloatNode';
import {FunctionNode} from '../core/FunctionNode';
import {TextureNode} from '../inputs/TextureNode';

export class BumpMapNode extends TempNode {

	static Nodes: {
		dHdxy_fwd: FunctionNode;
		perturbNormalArb: FunctionNode;
		bumpToNormal: FunctionNode;
	}
	value: TextureNode;
	scale: FloatNode;
	toNormalMap: boolean;
	nodeType: string;

	constructor(value: TextureNode, scale?: FloatNode);

	copy(source: BumpMapNode): this;

}
