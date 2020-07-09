import {Color, Vector2} from '../../../../../src/Three';

import {NodeBuilder} from '../../core/NodeBuilder';
import {StandardNode} from './StandardNode';
import {PropertyNode} from '../../inputs/PropertyNode';

export class MeshStandardNode extends StandardNode {

	properties: {
		color: Color;
		roughness: number;
		metalness: number;
		normalScale: Vector2;
	}
	inputs: {
		color: PropertyNode
		roughness: PropertyNode
		metalness: PropertyNode
		normalScale: PropertyNode
	}

	constructor();

	build(builder: NodeBuilder): string;

}
