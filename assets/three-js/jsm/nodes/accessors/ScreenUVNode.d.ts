import {TempNode} from '../core/TempNode';
import {ResolutionNode} from './ResolutionNode';

export class ScreenUVNode extends TempNode {

	resolution: ResolutionNode;
	nodeType: string;

	constructor(resolution?: ResolutionNode);

	copy(source: ScreenUVNode): this;

}
