import {Quaternion} from './Quaternion';

/**
 *
 * @see <a href="https://github.com/mrdoob/three.js/blob/master/src/math/Math.js">src/math/Math.js</a>
 */
export namespace MathUtils {
	export const DEG2RAD: number;
	export const RAD2DEG: number;

	export function generateUUID(): string;

	/**
	 * Clamps the x to be between a and b.
	 *
	 * @param value Value to be clamped.
	 * @param min Minimum value
	 * @param max Maximum value.
	 */
	export function clamp(value: number, min: number, max: number): number;

	export function euclideanModulo(n: number, m: number): number;

	/**
	 * Linear mapping of x from range [a1, a2] to range [b1, b2].
	 *
	 * @param x Value to be mapped.
	 * @param a1 Minimum value for range A.
	 * @param a2 Maximum value for range A.
	 * @param b1 Minimum value for range B.
	 * @param b2 Maximum value for range B.
	 */
	export function mapLinear(
		x: number,
		a1: number,
		a2: number,
		b1: number,
		b2: number
	): number;

	export function smoothstep(x: number, min: number, max: number): number;

	export function smootherstep(x: number, min: number, max: number): number;

	/**
	 * Random float from 0 to 1 with 16 bits of randomness.
	 * Standard Math.random() creates repetitive patterns when applied over larger space.
	 *
	 * @deprecated Use {@link Math#random Math.random()}
	 */
	export function random16(): number;

	/**
	 * Random integer from low to high interval.
	 */
	export function randInt(low: number, high: number): number;

	/**
	 * Random float from low to high interval.
	 */
	export function randFloat(low: number, high: number): number;

	/**
	 * Random float from - range / 2 to range / 2 interval.
	 */
	export function randFloatSpread(range: number): number;

	export function degToRad(degrees: number): number;

	export function radToDeg(radians: number): number;

	export function isPowerOfTwo(value: number): boolean;

	/**
	 * Returns a value linearly interpolated from two known points based
	 * on the given interval - t = 0 will return x and t = 1 will return y.
	 *
	 * @param x Start point.
	 * @param y End point.
	 * @param t interpolation factor in the closed interval [0, 1]
	 * @return {number}
	 */
	export function lerp(x: number, y: number, t: number): number;

	/**
	 * @deprecated Use {@link Math#floorPowerOfTwo .floorPowerOfTwo()}
	 */
	export function nearestPowerOfTwo(value: number): number;

	/**
	 * @deprecated Use {@link Math#ceilPowerOfTwo .ceilPowerOfTwo()}
	 */
	export function nextPowerOfTwo(value: number): number;

	export function floorPowerOfTwo(value: number): number;

	export function ceilPowerOfTwo(value: number): number;

	export function setQuaternionFromProperEuler(q: Quaternion, a: number, b: number, c: number, order: string): void;
}
