import {Group} from '../../objects/Group';
import {Camera} from '../../cameras/Camera';

export class WebXRManager {

	enabled: boolean;
	isPresenting: boolean;

	constructor(renderer: any, gl: WebGLRenderingContext);

	getController(id: number): Group;

	getControllerGrip(id: number): Group;

	setFramebufferScaleFactor(value: number): void;

	setReferenceSpaceType(value: string): void;

	getReferenceSpace(): any;

	getSession(): any;

	setSession(value: any): void;

	getCamera(camera: Camera): Camera;

	setAnimationLoop(callback: Function): void;

	dispose(): void;

}
