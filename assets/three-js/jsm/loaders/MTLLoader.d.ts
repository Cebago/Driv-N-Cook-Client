import {
	BufferGeometry,
	Loader,
	LoadingManager,
	Mapping,
	Material,
	Side,
	Texture,
	Vector2,
	Wrapping
} from '../../../src/Three';

export interface MaterialCreatorOptions {
	/**
	 * side: Which side to apply the material
	 * THREE.FrontSide (default), THREE.BackSide, THREE.DoubleSide
	 */
	side?: Side;
	/*
   * wrap: What type of wrapping to apply for textures
   * THREE.RepeatWrapping (default), THREE.ClampToEdgeWrapping, THREE.MirroredRepeatWrapping
   */
	wrap?: Wrapping;
	/*
   * normalizeRGB: RGBs need to be normalized to 0-1 from 0-255
   * Default: false, assumed to be already normalized
   */
	normalizeRGB?: boolean;
	/*
   * ignoreZeroRGBs: Ignore values of RGBs (Ka,Kd,Ks) that are all 0's
   * Default: false
   */
	ignoreZeroRGBs?: boolean;
	/*
   * invertTrProperty: Use values 1 of Tr field for fully opaque. This option is useful for obj
   * exported from 3ds MAX, vcglib or meshlab.
   * Default: false
   */
	invertTrProperty?: boolean;
}

export class MTLLoader extends Loader {

	materialOptions: MaterialCreatorOptions;

	constructor(manager?: LoadingManager);

	load(url: string, onLoad: (materialCreator: MTLLoader.MaterialCreator) => void, onProgress?: (event: ProgressEvent) => void, onError?: (event: ErrorEvent) => void): void;

	parse(text: string, path: string): MTLLoader.MaterialCreator;

	setMaterialOptions(value: MaterialCreatorOptions): void;

}

export interface MaterialInfo {
	ks?: number[];
	kd?: number[];
	ke?: number[];
	map_kd?: string;
	map_ks?: string;
	map_ke?: string;
	norm?: string;
	map_bump?: string;
	bump?: string;
	map_d?: string;
	ns?: number;
	d?: number;
	tr?: number;
}

export interface TexParams {
	scale: Vector2;
	offset: Vector2;
	url: string;
}

export namespace MTLLoader {
	export class MaterialCreator {

		baseUrl: string;
		options: MaterialCreatorOptions;
		materialsInfo: { [key: string]: MaterialInfo };
		materials: { [key: string]: Material };
		nameLookup: { [key: string]: number };
		side: Side;
		wrap: Wrapping;
		crossOrigin: string;
		private materialsArray: Material[];

		constructor(baseUrl?: string, options?: MaterialCreatorOptions);

		setCrossOrigin(value: string): this;

		setManager(value: LoadingManager): void;

		setMaterials(materialsInfo: { [key: string]: MaterialInfo }): void;

		convert(materialsInfo: { [key: string]: MaterialInfo }): { [key: string]: MaterialInfo };

		preload(): void;

		getIndex(materialName: string): Material;

		getAsArray(): Material[];

		create(materialName: string): Material;

		createMaterial_(materialName: string): Material;

		getTextureParams(value: string, matParams: any): TexParams;

		loadTexture(url: string, mapping?: Mapping, onLoad?: (bufferGeometry: BufferGeometry) => void, onProgress?: (event: ProgressEvent) => void, onError?: (event: ErrorEvent) => void): Texture;

	}
}
