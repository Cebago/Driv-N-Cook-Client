import {DiscreteInterpolant} from './../math/interpolants/DiscreteInterpolant';
import {LinearInterpolant} from './../math/interpolants/LinearInterpolant';
import {CubicInterpolant} from './../math/interpolants/CubicInterpolant';
import {InterpolationModes} from '../constants';

export class KeyframeTrack {

	name: string;
	times: Float32Array;
	values: Float32Array;
	ValueTypeName: string;
	TimeBufferType: Float32Array;
	ValueBufferType: Float32Array;
	DefaultInterpolation: InterpolationModes;

	constructor(
		name: string,
		times: any[],
		values: any[],
		interpolation?: InterpolationModes
	);

	static toJSON(track: KeyframeTrack): any;

	InterpolantFactoryMethodDiscrete(result: any): DiscreteInterpolant;

	InterpolantFactoryMethodLinear(result: any): LinearInterpolant;

	InterpolantFactoryMethodSmooth(result: any): CubicInterpolant;

	setInterpolation(interpolation: InterpolationModes): KeyframeTrack;

	getInterpolation(): InterpolationModes;

	getValueSize(): number;

	shift(timeOffset: number): KeyframeTrack;

	scale(timeScale: number): KeyframeTrack;

	trim(startTime: number, endTime: number): KeyframeTrack;

	validate(): boolean;

	optimize(): KeyframeTrack;

	clone(): KeyframeTrack;

}
