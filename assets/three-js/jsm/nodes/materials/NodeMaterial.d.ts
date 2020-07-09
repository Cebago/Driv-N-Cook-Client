import {ShaderMaterial, WebGLRenderer} from '../../../../src/Three';

import {NodeBuilder} from '../core/NodeBuilder';
import {NodeFrame} from '../core/NodeFrame';
import {MeshStandardNode} from './nodes/MeshStandardNode';
import {RawNode} from './nodes/RawNode';

export interface NodeMaterialBuildParams {
	builder?: NodeBuilder;
	renderer?: WebGLRenderer;
}

export class NodeMaterial extends ShaderMaterial {

	vertex: MeshStandardNode | RawNode;
	fragment: MeshStandardNode | RawNode;
	updaters: object[];
	readonly isNodeMaterial: true;
	properties: object;

	constructor(vertex: MeshStandardNode, fragment: MeshStandardNode);

	updateFrame(frame: NodeFrame): void;

	build(params?: NodeMaterialBuildParams): this;

	copy(source: NodeMaterial): this;

}
