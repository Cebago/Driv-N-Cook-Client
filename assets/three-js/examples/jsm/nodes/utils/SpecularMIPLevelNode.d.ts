import {TempNode} from '../core/TempNode';
import {MaxMIPLevelNode} from '../utils/MaxMIPLevelNode';
import {FunctionNode} from '../core/FunctionNode';

export class SpecularMIPLevelNode extends TempNode {

	static Nodes: {
		getSpecularMIPLevel: FunctionNode;
	};
	texture: Node;
	maxMIPLevel: MaxMIPLevelNode;
	nodeType: string;

	constructor(texture: Node);

	copy(source: SpecularMIPLevelNode): this;

}
