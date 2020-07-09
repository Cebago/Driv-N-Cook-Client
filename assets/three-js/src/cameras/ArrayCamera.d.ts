import {PerspectiveCamera} from './PerspectiveCamera';

export class ArrayCamera extends PerspectiveCamera {

	cameras: PerspectiveCamera[];
	readonly isArrayCamera: true;

	constructor(cameras?: PerspectiveCamera[]);

}
