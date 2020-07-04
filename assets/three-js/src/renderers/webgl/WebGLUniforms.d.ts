import {WebGLProgram} from './WebGLProgram';
import {WebGLTextures} from './WebGLTextures';

export class WebGLUniforms {

	constructor(gl: WebGLRenderingContext, program: WebGLProgram);

	static upload(gl: WebGLRenderingContext, seq: any, values: any[], textures: WebGLTextures): void;

	static seqWithValue(seq: any, values: any[]): any[];

	setValue(gl: WebGLRenderingContext, name: string, value: any, textures: WebGLTextures): void;

	setOptional(gl: WebGLRenderingContext, object: any, name: string): void;

}
