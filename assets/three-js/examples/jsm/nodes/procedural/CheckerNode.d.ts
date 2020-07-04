import {TempNode} from '../core/TempNode';
import {FunctionNode} from '../core/FunctionNode';
import {UVNode} from '../accessors/UVNode';
import {UVTransformNode} from '../utils/UVTransformNode';

export class CheckerNode extends TempNode {

	static Nodes: {
		checker: FunctionNode;
	};
	uv: UVNode | UVTransformNode;
	nodeType: string;

	constructor(uv?: UVNode | UVTransformNode);

	copy(source: CheckerNode): this;

}
