import {TempNode} from '../core/TempNode';

export class LightNode extends TempNode {

	static TOTAL: string;
	scope: string;
	nodeType: string;

	constructor(scope?: string);

	copy(source: LightNode): this;

}
