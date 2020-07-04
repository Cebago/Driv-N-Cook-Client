import {ShaderPass} from '../../postprocessing/ShaderPass';
import {ScreenNode} from '../inputs/ScreenNode';

export class NodePass extends ShaderPass {

	name: string;
	uuid: string;
	userData: object;
	input: ScreenNode;
	needsUpdate: boolean;

	constructor();

	copy(source: NodePass): this;

	toJSON(meta?: object | string): object;

}
