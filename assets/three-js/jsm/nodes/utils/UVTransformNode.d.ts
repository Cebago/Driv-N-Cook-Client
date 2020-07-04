import {ExpressionNode} from '../core/ExpressionNode';
import {Matrix3Node} from '../inputs/Matrix3Node';
import {UVNode} from '../accessors/UVNode';

export class UVTransformNode extends ExpressionNode {

	uv: UVNode;
	position: Matrix3Node;
	nodeType: string;

	constructor(uv?: UVNode, position?: Matrix3Node);

	setUvTransform(tx: number, ty: number, sx: number, sy: number, rotation: number, cx?: number, cy?: number): void;

	copy(source: UVTransformNode): this;

}
