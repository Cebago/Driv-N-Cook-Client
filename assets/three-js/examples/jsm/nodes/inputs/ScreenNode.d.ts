import {NodeBuilder} from '../core/NodeBuilder';
import {TextureNode} from './TextureNode';
import {UVNode} from '../accessors/UVNode';

export class ScreenNode extends TextureNode {

	nodeType: string;

	constructor(uv?: UVNode);

	getTexture(builder: NodeBuilder, output: string): string;

}
