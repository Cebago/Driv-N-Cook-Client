import {TempNode} from '../core/TempNode';

export class ColorsNode extends TempNode {

	index: number;
	nodeType: string;

	constructor(index?: number);

	copy(source: ColorsNode): this;

}
