import {WebGLRenderer} from './../WebGLRenderer';
import {WebGLProgram} from './WebGLProgram';
import {WebGLCapabilities} from './WebGLCapabilities';
import {WebGLExtensions} from './WebGLExtensions';
import {Material} from './../../materials/Material';
import {Scene} from './../../scenes/Scene';

export class WebGLPrograms {

	programs: WebGLProgram[];

	constructor(renderer: WebGLRenderer, extensions: WebGLExtensions, capabilities: WebGLCapabilities);

	getParameters(
		material: Material,
		lights: object[],
		shadows: object[],
		scene: Scene,
		nClipPlanes: number,
		nClipIntersection: number,
		object: any
	): any;

	getProgramCacheKey(parameters: any): string;

	acquireProgram(
		parameters: any,
		cacheKey: string
	): WebGLProgram;

	releaseProgram(program: WebGLProgram): void;

}
