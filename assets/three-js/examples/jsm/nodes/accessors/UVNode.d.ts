import {TempNode} from '../core/TempNode';

export class UVNode extends TempNode {

	index: number;
	nodeType: string;

	constructor(index?: number);

	copy(source: UVNode): this;

}
