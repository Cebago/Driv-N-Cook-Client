import {InputNode} from '../core/InputNode';

export class PropertyNode extends InputNode {

	object: object;
	property: string;
	nodeType: string;
	value: any;

	constructor(object: object, property: string, type: string);

}
