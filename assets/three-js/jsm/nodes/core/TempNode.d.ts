import {Node} from './Node';
import {NodeBuilder} from './NodeBuilder';

export interface TempNodeParams {
	shared?: boolean;
	unique?: boolean;
}

export class TempNode extends Node {

	shared: boolean;
	unique: boolean;
	label: string | undefined;

	constructor(type: string, params?: TempNodeParams);

	build(builder: NodeBuilder, output: string, uuid?: string, ns?: string): string;

	getShared(builder: NodeBuilder, output: string): boolean;

	getUnique(builder: NodeBuilder, output: string): boolean;

	setLabel(name: string): this;

	getLabel(builder: NodeBuilder): string;

	getUuid(unique: boolean): string;

	getTemp(builder: NodeBuilder, uuid: string): string | undefined;

}
