import {CubeTexture, Mesh, PerspectiveCamera, Scene} from '../../../src/Three';

import {Pass} from './Pass';

export class CubeTexturePass extends Pass {

	camera: PerspectiveCamera;
	cubeShader: object;
	cubeMesh: Mesh;
	envMap: CubeTexture;
	opacity: number;
	cubeScene: Scene;
	cubeCamera: PerspectiveCamera;

	constructor(camera: PerspectiveCamera, envMap?: CubeTexture, opacity?: number);

}
