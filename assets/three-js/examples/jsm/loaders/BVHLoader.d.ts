import {AnimationClip, Loader, LoadingManager, Skeleton} from '../../../src/Three';


export interface BVH {
	clip: AnimationClip;
	skeleton: Skeleton;
}

export class BVHLoader extends Loader {

	animateBonePositions: boolean;
	animateBoneRotations: boolean;

	constructor(manager?: LoadingManager);

	load(url: string, onLoad: (bvh: BVH) => void, onProgress?: (event: ProgressEvent) => void, onError?: (event: ErrorEvent) => void): void;

	parse(text: string): BVH;

}
