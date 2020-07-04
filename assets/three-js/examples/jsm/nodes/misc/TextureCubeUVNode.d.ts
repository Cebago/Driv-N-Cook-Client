import {TempNode} from '../core/TempNode';
import {FloatNode} from '../inputs/FloatNode';
import {StructNode} from '../core/StructNode';
import {FunctionNode} from '../core/FunctionNode';
import {Node} from '../core/Node';

export class TextureCubeUVNode extends TempNode {

	static Nodes: {
		TextureCubeUVData: StructNode;
		textureCubeUV: FunctionNode;
	}
	uv: Node;
	textureSize: FloatNode;
	nodeType: string;

	constructor(uv: Node, textureSize: FloatNode);

}
