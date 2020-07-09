import {Node} from './Node';
import {FunctionNode} from './FunctionNode';
import {TempNode} from './TempNode';

export class FunctionCallNode extends TempNode {

	nodeType: string;
	value: FunctionNode;
	inputs: Node[];

	constructor(func: FunctionNode, inputs?: Node[]);

	setFunction(func: FunctionNode, inputs?: Node[]): void;

	getFunction(): FunctionNode;

	getType(): string;

	copy(source: FunctionCallNode): this;

}
