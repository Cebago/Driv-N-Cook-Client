import {AnimationClip} from './AnimationClip';
import {AnimationAction} from './AnimationAction';
import {AnimationBlendMode} from '../constants';
import {EventDispatcher} from './../core/EventDispatcher';
import {Object3D} from '../core/Object3D';
import {AnimationObjectGroup} from './AnimationObjectGroup';

export class AnimationMixer extends EventDispatcher {

	time: number;
	timeScale: number;

	constructor(root: Object3D | AnimationObjectGroup);

	clipAction(clip: AnimationClip, root?: Object3D | AnimationObjectGroup, blendMode?: AnimationBlendMode): AnimationAction;

	existingAction(clip: AnimationClip, root?: Object3D | AnimationObjectGroup): AnimationAction | null;

	stopAllAction(): AnimationMixer;

	update(deltaTime: number): AnimationMixer;

	setTime(timeInSeconds: number): AnimationMixer;

	getRoot(): Object3D | AnimationObjectGroup;

	uncacheClip(clip: AnimationClip): void;

	uncacheRoot(root: Object3D | AnimationObjectGroup): void;

	uncacheAction(clip: AnimationClip, root?: Object3D | AnimationObjectGroup): void;

}
