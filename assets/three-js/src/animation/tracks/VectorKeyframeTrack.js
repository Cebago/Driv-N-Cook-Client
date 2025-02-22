import {KeyframeTrack} from '../KeyframeTrack.js';

/**
 *
 * A Track of vectored keyframe values.
 *
 *
 * @author Ben Houston / http://clara.io/
 * @author David Sarno / http://lighthaus.us/
 * @author tschw
 */

function VectorKeyframeTrack(name, times, values, interpolation) {

	KeyframeTrack.call(this, name, times, values, interpolation);

}

VectorKeyframeTrack.prototype = Object.assign(Object.create(KeyframeTrack.prototype), {

	constructor: VectorKeyframeTrack,

	ValueTypeName: 'vector'

	// ValueBufferType is inherited

	// DefaultInterpolation is inherited

});

export {VectorKeyframeTrack};
