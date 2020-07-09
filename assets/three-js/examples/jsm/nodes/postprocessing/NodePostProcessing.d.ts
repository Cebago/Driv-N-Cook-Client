import {Camera, Mesh, OrthographicCamera, Scene, WebGLRenderer, WebGLRenderTarget,} from '../../../../src/Three';

import {ScreenNode} from '../inputs/ScreenNode';
import {NodeMaterial} from '../materials/NodeMaterial';
import {NodeFrame} from '../core/NodeFrame';

export class NodePostProcessing {

	renderer: WebGLRenderer;
	renderTarget: WebGLRenderTarget;
	output: ScreenNode;
	material: NodeMaterial
	camera: OrthographicCamera;
	scene: Scene;
	quad: Mesh;
	needsUpdate: boolean;

	constructor(renderer: WebGLRenderer, renderTarget?: WebGLRenderTarget);

	render(scene: Scene, camera: Camera, frame: NodeFrame): void;

	setSize(width: number, height: number): void;

	copy(source: NodePostProcessing): this;

	toJSON(meta?: object | string): object;

}
