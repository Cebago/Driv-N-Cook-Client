import {Scene} from './../../scenes/Scene';
import {Camera} from './../../cameras/Camera';
import {WebGLRenderer} from '../WebGLRenderer';
import {ShadowMapType} from '../../constants';

export class WebGLShadowMap {

	enabled: boolean;
	autoUpdate: boolean;
	needsUpdate: boolean;
	type: ShadowMapType;
	/**
	 * @deprecated Use {@link WebGLShadowMap#renderReverseSided .shadowMap.renderReverseSided} instead.
	 */
	cullFace: any;

	constructor(
		_renderer: WebGLRenderer,
		_objects: any[],
		maxTextureSize: number
	);

	render(scene: Scene, camera: Camera): void;

}
