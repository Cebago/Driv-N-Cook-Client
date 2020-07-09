import {TempNode} from './TempNode';
import {NodeBuilder} from './NodeBuilder';

export class AttributeNode extends TempNode {

	name: string;
	nodeType: string;

	constructor(name: string, type?: string);

	getAttributeType(builder: NodeBuilder): string;

	getType(builder: NodeBuilder): string;

	copy(source: AttributeNode): this;

}
