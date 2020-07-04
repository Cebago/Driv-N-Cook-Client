import {LightProbe, Mesh} from '../../../src/Three';

export class LightProbeHelper extends Mesh {

	lightProbe: LightProbe;
	size: number;

	constructor(lightProbe: LightProbe, size: number);

	dispose(): void;

}
