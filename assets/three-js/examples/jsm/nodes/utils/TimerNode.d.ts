import {NodeFrame} from '../core/NodeFrame';
import {FloatNode} from '../inputs/FloatNode';

export class TimerNode extends FloatNode {

	static GLOBAL: string;
	static LOCAL: string;
	static DELTA: string;
	scale: number;
	scope: string;
	timeScale: boolean;
	nodeType: string;

	constructor(scale?: number, scope?: string, timeScale?: boolean);

	getUnique(): boolean;

	updateFrame(frame: NodeFrame): void;

	copy(source: TimerNode): this;

}
