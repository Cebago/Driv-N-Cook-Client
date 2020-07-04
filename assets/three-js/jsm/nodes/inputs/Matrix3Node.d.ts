import {Matrix3} from '../../../../src/Three';

import {InputNode} from '../core/InputNode';
import {NodeBuilder} from '../core/NodeBuilder';

export class Matrix3Node extends InputNode {

	value: Matrix3;
	nodeType: string;
	elements: number[];

	constructor(matrix?: Matrix3);

	generateReadonly(builder: NodeBuilder, output: string, uuid?: string, type?: string, ns?: string, needsUpdate?: boolean): string;

	copy(source: Matrix3Node): this;

}
