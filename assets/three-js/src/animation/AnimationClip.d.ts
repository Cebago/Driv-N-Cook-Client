import {KeyframeTrack} from './KeyframeTrack';
import {Bone} from './../objects/Bone';
import {MorphTarget} from '../core/Geometry';
import {AnimationBlendMode} from '../constants';

export class AnimationClip {

	name: string;
	tracks: KeyframeTrack[];
	blendMode: AnimationBlendMode;
	duration: number;
	uuid: string;
	results: any[];

	constructor(name?: string, duration?: number, tracks?: KeyframeTrack[], blendMode?: AnimationBlendMode);

	static CreateFromMorphTargetSequence(
		name: string,
		morphTargetSequence: MorphTarget[],
		fps: number,
		noLoop: boolean
	): AnimationClip;

	static findByName(clipArray: AnimationClip[], name: string): AnimationClip;

	static CreateClipsFromMorphTargetSequences(
		morphTargets: MorphTarget[],
		fps: number,
		noLoop: boolean
	): AnimationClip[];

	static parse(json: any): AnimationClip;

	static parseAnimation(
		animation: any,
		bones: Bone[]
	): AnimationClip;

	static toJSON(): any;

	resetDuration(): AnimationClip;

	trim(): AnimationClip;

	validate(): boolean;

	optimize(): AnimationClip;

	clone(): AnimationClip;

}
