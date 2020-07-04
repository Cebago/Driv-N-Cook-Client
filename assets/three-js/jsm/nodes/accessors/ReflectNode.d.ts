import {TempNode} from '../core/TempNode';

export class ReflectNode extends TempNode {

	static CUBE: string;
	static SPHERE: string;
	static VECTOR: string;
	scope: string;
	nodeType: string;

	constructor(scope?: string);

}
