export namespace CodeSerializer {

	export function serializeClass(targetPrototype: object, targetPrototypeInstance: object, basePrototypeName?: string, overrideFunctions?: CodeSerializationInstruction[]): string;

}

export class CodeSerializationInstruction {

	name: string;
	fullName: string;
	code: string;
	removeCode: boolean;

	constructor(name: string, fullName: string);

	getName(): string;

	getFullName(): string;

	setCode(code: string): this;

	getCode(): string;

	setRemoveCode(removeCode: boolean): this;

	isRemoveCode(): boolean;

}
