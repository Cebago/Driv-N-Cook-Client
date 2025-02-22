import {Curve} from './../extras/core/Curve';
import {Vector2} from './../math/Vector2';
import {Vector3} from './../math/Vector3';
import {Shape} from './../extras/core/Shape';
import {Geometry} from './../core/Geometry';
import {BufferGeometry} from './../core/BufferGeometry';

export interface ExtrudeGeometryOptions {
	curveSegments?: number;
	steps?: number;
	depth?: number;
	bevelEnabled?: boolean;
	bevelThickness?: number;
	bevelSize?: number;
	bevelOffset?: number;
	bevelSegments?: number;
	extrudePath?: Curve<Vector3>;
	UVGenerator?: UVGenerator;
}

export interface UVGenerator {
	generateTopUV(
		geometry: ExtrudeBufferGeometry,
		vertices: number[],
		indexA: number,
		indexB: number,
		indexC: number
	): Vector2[];

	generateSideWallUV(
		geometry: ExtrudeBufferGeometry,
		vertices: number[],
		indexA: number,
		indexB: number,
		indexC: number,
		indexD: number
	): Vector2[];
}

export class ExtrudeBufferGeometry extends BufferGeometry {

	static WorldUVGenerator: UVGenerator;

	constructor(shapes: Shape | Shape[], options?: ExtrudeGeometryOptions);

	addShapeList(shapes: Shape[], options?: any): void;

	addShape(shape: Shape, options?: any): void;

}

export class ExtrudeGeometry extends Geometry {

	static WorldUVGenerator: UVGenerator;

	constructor(shapes: Shape | Shape[], options?: ExtrudeGeometryOptions);

	addShapeList(shapes: Shape[], options?: any): void;

	addShape(shape: Shape, options?: any): void;

}
