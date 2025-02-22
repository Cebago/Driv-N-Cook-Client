declare interface Stats {
	REVISION: number;
	dom: HTMLDivElement;
	domElement: HTMLDivElement;

	addPanel(panel: Stats.Panel): Stats.Panel;

	showPanel(id: number): void;

	begin(): void;

	end(): void;

	update(): void;

	setMode(id: number): void;
}

declare function Stats(): Stats;

declare namespace Stats {
	interface Panel {
		dom: HTMLCanvasElement;

		update(value: number, maxValue: number): void;
	}

	function Panel(): Panel;
}

export default Stats
