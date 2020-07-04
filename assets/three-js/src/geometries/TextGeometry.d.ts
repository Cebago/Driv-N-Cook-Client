import {Font} from './../extras/core/Font';
import {ExtrudeBufferGeometry, ExtrudeGeometry} from './ExtrudeGeometry';

export interface TextGeometryParameters {
	font: Font;
	size?: number;
	height?: number;
	curveSegments?: number;
	bevelEnabled?: boolean;
	bevelThickness?: number;
	bevelSize?: number;
	bevelOffset?: number;
	bevelSegments?: number;
}

export class TextBufferGeometry extends ExtrudeBufferGeometry {

	parameters: {
		font: Font;
		size: number;
		height: number;
		curveSegments: number;
		bevelEnabled: boolean;
		bevelThickness: number;
		bevelSize: number;
		bevelOffset: number;
		bevelSegments: number;
	};

	constructor(text: string, parameters: TextGeometryParameters);

}

export class TextGeometry extends ExtrudeGeometry {

	parameters: {
		font: Font;
		size: number;
		height: number;
		curveSegments: number;
		bevelEnabled: boolean;
		bevelThickness: number;
		bevelSize: number;
		bevelOffset: number;
		bevelSegments: number;
	};

	constructor(text: string, parameters: TextGeometryParameters);

}
