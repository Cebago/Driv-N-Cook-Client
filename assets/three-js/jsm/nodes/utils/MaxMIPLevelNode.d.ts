import {FloatNode} from '../inputs/FloatNode';
import {Node} from '../core/Node';

export class MaxMIPLevelNode extends FloatNode {

	texture: Node;
	maxMIPLevel: number;
	nodeType: string;
	value: number;

	constructor(texture: Node);

}
