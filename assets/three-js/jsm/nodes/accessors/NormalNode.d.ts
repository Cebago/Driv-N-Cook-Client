import {TempNode} from '../core/TempNode';

export class NormalNode extends TempNode {

	static LOCAL: string;
	static WORLD: string;
	scope: string;
	nodeType: string;

	constructor(scope?: string);

	copy(source: NormalNode): this;

}
