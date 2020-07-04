import {TempNode} from '../core/TempNode';

export class PositionNode extends TempNode {

	static LOCAL: string;
	static WORLD: string;
	static VIEW: string;
	static PROJECTION: string;
	scope: string;
	nodeType: string;

	constructor(scope?: string);

	copy(source: PositionNode): this;

}
