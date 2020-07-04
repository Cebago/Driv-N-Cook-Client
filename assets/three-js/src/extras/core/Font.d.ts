import {Shape} from './Shape';

export class Font {

	data: string;

	constructor(jsondata: any);

	generateShapes(text: string, size: number): Shape[];

}
