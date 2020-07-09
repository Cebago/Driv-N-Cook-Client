import {TempNode} from './TempNode';
import {NodeBuilder} from './NodeBuilder';

export interface StructNodeInput {
	type: string;
	name: string;
}

export class StructNode extends TempNode {

	inputs: StructNodeInput[];
	src: string;
	nodeType: string;

	constructor(src?: string);

	getType(builder: NodeBuilder): string;

	getInputByName(name: string): StructNodeInput;

	parse(src: string): void;

}
