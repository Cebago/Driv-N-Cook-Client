import {Texture} from '../../../../src/Three';

import {InputNode} from '../core/InputNode';
import {NodeBuilder} from '../core/NodeBuilder';
import {Node} from '../core/Node';
import {UVNode} from '../accessors/UVNode';

export class TextureNode extends InputNode {

	value: Texture;
	uv: UVNode;
	bias: Node;
	project: boolean;
	nodeType: string;

	constructor(value: Texture, uv?: UVNode, bias?: Node, project?: boolean);

	getTexture(builder: NodeBuilder, output: string): string;

	copy(source: TextureNode): this;

}
