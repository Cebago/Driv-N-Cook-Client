import {Node} from '../core/Node';
import {TempNode} from '../core/TempNode';
import {FunctionNode} from '../core/FunctionNode';

export class ColorSpaceNode extends TempNode {

	static Nodes: {
		LinearToLinear: FunctionNode;
		GammaToLinear: FunctionNode;
		LinearToGamma: FunctionNode;
		sRGBToLinear: FunctionNode;
		LinearTosRGB: FunctionNode;
		RGBEToLinear: FunctionNode;
		LinearToRGBE: FunctionNode;
		RGBMToLinear: FunctionNode;
		LinearToRGBM: FunctionNode;
		RGBDToLinear: FunctionNode;
		LinearToRGBD: FunctionNode;
		cLogLuvM: FunctionNode;
		LinearToLogLuv: FunctionNode;
		cLogLuvInverseM: FunctionNode;
		LogLuvToLinear: FunctionNode;
	};
	static LINEAR_TO_LINEAR: string;
	static GAMMA_TO_LINEAR: string;
	static LINEAR_TO_GAMMA: string;
	static SRGB_TO_LINEAR: string;
	static LINEAR_TO_SRGB: string;
	static RGBE_TO_LINEAR: string;
	static LINEAR_TO_RGBE: string;
	static RGBM_TO_LINEAR: string;
	static LINEAR_TO_RGBM: string;
	static RGBD_TO_LINEAR: string;
	static LINEAR_TO_RGBD: string;
	static LINEAR_TO_LOG_LUV: string;
	static LOG_LUV_TO_LINEAR: string;
	input: Node;
	method: string | undefined;
	nodeType: string;

	constructor(input: Node, method?: string);

	static getEncodingComponents(encoding: number): any[];

	fromEncoding(encoding: number);

	fromDecoding(encoding: number);

	copy(source: ColorSpaceNode): this;

}
