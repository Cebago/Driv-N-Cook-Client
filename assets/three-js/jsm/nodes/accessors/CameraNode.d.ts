import {Camera} from '../../../../src/Three';

import {NodeFrame} from '../core/NodeFrame';
import {TempNode} from '../core/TempNode';
import {FunctionNode} from '../core/FunctionNode';
import {FloatNode} from '../inputs/FloatNode';

export class CameraNode extends TempNode {

	static Nodes: {
		depthColor: FunctionNode;
	};
	static POSITION: string;
	static DEPTH: string;
	static TO_VERTEX: string;
	scope: string;
	near: FloatNode | undefined;
	far: FloatNode | undefined;
	camera: Camera | undefined;
	updateFrame: boolean | undefined;
	nodeType: string;

	constructor(scope?: string, camera?: Camera);

	setCamera(camera: Camera): void;

	setScope(scope: string): void;

	onUpdateFrame(frame: NodeFrame): void;

	copy(source: CameraNode): this;

}
