import {Audio} from './Audio';

export class AudioAnalyser {

	analyser: AnalyserNode;
	data: Uint8Array;

	constructor(audio: Audio<AudioNode>, fftSize: number);

	getFrequencyData(): Uint8Array;

	getAverageFrequency(): number;

	/**
	 * @deprecated Use {@link AudioAnalyser#getFrequencyData .getFrequencyData()} instead.
	 */
	getData(file: any): any;

}
