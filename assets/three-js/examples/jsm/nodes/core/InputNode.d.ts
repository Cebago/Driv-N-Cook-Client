import {TempNode, TempNodeParams} from './TempNode';
import {NodeBuilder} from './NodeBuilder';

export class InputNode extends TempNode {

	readonly: boolean;

	constructor(type: string, params?: TempNodeParams);

	setReadonly(value: boolean): this;

	getReadonly(builder: NodeBuilder): boolean;

	copy(source: InputNode): this;

}
