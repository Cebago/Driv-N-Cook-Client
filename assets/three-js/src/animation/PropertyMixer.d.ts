export class PropertyMixer {

	binding: any;
	valueSize: number;
	buffer: any;
	cumulativeWeight: number;
	cumulativeWeightAdditive: number;
	useCount: number;
	referenceCount: number;

	constructor(binding: any, typeName: string, valueSize: number);

	accumulate(accuIndex: number, weight: number): void;

	accumulateAdditive(weight: number): void;

	apply(accuIndex: number): void;

	saveOriginalState(): void;

	restoreOriginalState(): void;

}
