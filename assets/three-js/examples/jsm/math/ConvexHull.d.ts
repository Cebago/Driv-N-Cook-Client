import {Object3D, Ray, Vector3} from '../../../src/Three';

declare class Face {

	normal: Vector3;
	midpoint: Vector3;
	area: number;
	constant: number;
	outside: VertexNode;
	mark: number;
	edge: HalfEdge;

	constructor();

	static create(a: VertexNode, b: VertexNode, c: VertexNode): Face;

	compute(): this;

	getEdge(i: number): HalfEdge;

}

declare class HalfEdge {

	vertex: VertexNode;
	prev: HalfEdge;
	next: HalfEdge;
	twin: HalfEdge;
	face: Face;

	constructor(vertex: VertexNode, face: Face);

	head(): VertexNode;

	length(): number;

	lengthSquared(): number;

	setTwin(edge: HalfEdge): this;

	tail(): VertexNode;

}

declare class VertexNode {

	point: Vector3;
	prev: VertexNode;
	next: VertexNode;
	face: Face;

	constructor(point: Vector3);

}

declare class VertexList {

	head: VertexNode;
	tail: VertexNode;

	constructor();

	append(vertex: VertexNode): this;

	appendChain(vertex: VertexNode): this;

	clear(): this;

	first(): VertexNode;

	insertAfter(target: VertexNode, vertex: VertexNode): this;

	insertBefore(target: VertexNode, vertex: VertexNode): this;

	isEmpty(): boolean;

	last(): VertexNode;

	remove(vertex: VertexNode): this;

	removeSubList(a: VertexNode, b: VertexNode): this;

}

export class ConvexHull {

	tolerance: number;
	faces: Face[];
	newFaces: Face[];
	assigned: VertexList;
	unassigned: VertexList;
	vertices: VertexNode[];

	constructor();

	addAdjoiningFace(eyeVertex: VertexNode, horizonEdge: HalfEdge): HalfEdge;

	addNewFaces(eyeVertex: VertexNode, horizon: HalfEdge[]): this;

	addVertexToFace(vertex: VertexNode, face: Face): this;

	addVertexToHull(eyeVertex: VertexNode): this;

	cleanup(): this;

	compute(): this;

	computeExtremes(): object;

	computeHorizon(eyePoint: Vector3, crossEdge: HalfEdge, face: Face, horizon: HalfEdge[]): this;

	computeInitialHull(): this;

	containsPoint(point: Vector3): boolean;

	deleteFaceVertices(face: Face, absorbingFace: Face): this;

	intersectRay(ray: Ray, target: Vector3): Vector3 | null;

	intersectsRay(ray: Ray): boolean;

	makeEmpty(): this;

	nextVertexToAdd(): VertexNode | undefined;

	reindexFaces(): this;

	removeAllVerticesFromFace(face: Face): VertexNode | undefined;

	removeVertexFromFace(vertex: VertexNode, face: Face): this;

	resolveUnassignedPoints(newFaces: Face[]): this;

	setFromPoints(points: Vector3[]): this;

	setFromObject(object: Object3D): this;

}
