import {WebGLProgram} from './WebGLProgram';

/**
 * An object with a series of statistical information about the graphics board memory and the rendering process.
 */
export class WebGLInfo {

	autoReset: boolean;
	memory: {
		geometries: number;
		textures: number;
	};
	programs: WebGLProgram[] | null;
	render: {
		calls: number;
		frame: number;
		lines: number;
		points: number;
		triangles: number;
	};

	constructor(gl: WebGLRenderingContext);

	update(count: number, mode: GLenum, instanceCount: number): void;

	reset(): void;

}
