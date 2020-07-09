import {Object3D} from './../../core/Object3D';
import {Material} from './../../materials/Material';

// Extras / Objects /////////////////////////////////////////////////////////////////////

export class ImmediateRenderObject extends Object3D {

	material: Material;

	constructor(material: Material);

	render(renderCallback: Function): void;

}
