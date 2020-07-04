import {LoadingManager} from '../../../src/Three';

import {Volume} from '../misc/Volume';

export class NRRDLoader {

	manager: LoadingManager;
	path: string;
	fieldFunctions: object;

	constructor(manager?: LoadingManager);

	load(url: string, onLoad: (group: Volume) => void, onProgress?: (event: ProgressEvent) => void, onError?: (event: ErrorEvent) => void): void;

	parse(data: string): Volume;

	parseChars(array: number[], start?: number, end?: number): string;

	setPath(value: string): this;

}
