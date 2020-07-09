import {TempNode} from '../core/TempNode';

export class SubSlots extends TempNode {

	slots: Node[];

	constructor(slots?: object);

	copy(source: SubSlots): this;

}
