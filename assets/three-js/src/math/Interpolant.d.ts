export abstract class Interpolant {

	parameterPositions: any;
	sampleValues: any;
	valueSize: number;
	resultBuffer: any;

	constructor(
		parameterPositions: any,
		sampleValues: any,
		sampleSize: number,
		resultBuffer?: any
	);

	evaluate(time: number): any;

}
