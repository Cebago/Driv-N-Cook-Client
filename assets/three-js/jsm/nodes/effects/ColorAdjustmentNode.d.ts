import {TempNode} from '../core/TempNode';
import {FloatNode} from '../inputs/FloatNode';
import {FunctionNode} from '../core/FunctionNode';
import {Node} from '../core/Node';

export class ColorAdjustmentNode extends TempNode {

	static Nodes: {
		hue: FunctionNode;
		saturation: FunctionNode;
		vibrance: FunctionNode;
	}
	static SATURATION: string;
	static HUE: string;
	static VIBRANCE: string;
	static BRIGHTNESS: string;
	static CONTRAST: string;
	rgb: Node;
	adjustment: FloatNode | undefined;
	method: string;
	nodeType: string;

	constructor(rgb: Node, adjustment?: FloatNode, method?: string);

	copy(source: ColorAdjustmentNode): this;

}
