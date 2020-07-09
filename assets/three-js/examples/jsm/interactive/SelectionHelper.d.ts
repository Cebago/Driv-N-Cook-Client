import {Vector2, WebGLRenderer} from '../../../src/Three';

import {SelectionBox} from './SelectionBox';

export class SelectionHelper {

	element: HTMLElement;
	isDown: boolean;
	pointBottomRight: Vector2;
	pointTopLeft: Vector2;
	renderer: WebGLRenderer;
	startPoint: Vector2;

	constructor(selectionBox: SelectionBox, renderer: WebGLRenderer, cssClassName: string);

	onSelectStart(event: Event): void;

	onSelectMove(event: Event): void;

	onSelectOver(event: Event): void;

}
