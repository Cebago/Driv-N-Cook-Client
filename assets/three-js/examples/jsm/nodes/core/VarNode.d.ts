import {Node} from './Node';
import {NodeBuilder} from './NodeBuilder';

export class VarNode extends Node {

	value: any;
	nodeType: string;

	constructor(type: string, value?: any);

	getType(builder: NodeBuilder): string;

	copy(source: VarNode): this;

}
