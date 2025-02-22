import {TempNode} from './TempNode';
import {NodeBuilder} from './NodeBuilder';

export class ConstNode extends TempNode {

	static PI: string;
	static PI2: string;
	static RECIPROCAL_PI: string;
	static RECIPROCAL_PI2: string;
	static LOG2: string;
	static EPSILON: string;
	src: string;
	useDefine: boolean;
	nodeType: string;

	constructor(src: string, useDefine?: boolean);

	getType(builder: NodeBuilder): string;

	parse(src: string, useDefine?: boolean): void;

	build(builder: NodeBuilder, output: string): string;

	copy(source: ConstNode): this;

}
