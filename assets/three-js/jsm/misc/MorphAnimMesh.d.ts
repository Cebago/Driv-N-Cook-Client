import {AnimationAction, AnimationMixer, BufferGeometry, Geometry, Material, Mesh} from '../../../src/Three';

export class MorphAnimMesh extends Mesh {

	mixer: AnimationMixer;
	activeAction: AnimationAction | null;

	constructor(geometry: BufferGeometry | Geometry, material: Material);

	setDirectionForward(): void;

	setDirectionBackward(): void;

	playAnimation(label: string, fps: number): void;

	updateAnimation(delta: number): void;

	copy(source: MorphAnimMesh): this;

}
