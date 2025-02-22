import {LoadingManager} from './LoadingManager';
import {Loader} from './Loader';
import {AnimationClip} from './../animation/AnimationClip';

export class AnimationLoader extends Loader {

	constructor(manager?: LoadingManager);

	load(
		url: string,
		onLoad: (response: AnimationClip[]) => void,
		onProgress?: (request: ProgressEvent) => void,
		onError?: (event: ErrorEvent) => void
	): void;

	parse(json: any): AnimationClip[];

}
