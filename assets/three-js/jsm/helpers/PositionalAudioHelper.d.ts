import {Line, PositionalAudio} from '../../../src/Three';

export class PositionalAudioHelper extends Line {

	audio: PositionalAudio;
	range: number;
	divisionsInnerAngle: number;
	divisionsOuterAngle: number;

	constructor(audio: PositionalAudio, range?: number, divisionsInnerAngle?: number, divisionsOuterAngle?: number);

	dispose(): void;

	update(): void;

}
