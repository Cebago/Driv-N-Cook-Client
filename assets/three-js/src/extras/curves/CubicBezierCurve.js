import {Curve} from '../core/Curve.js';
import {CubicBezier} from '../core/Interpolations.js';
import {Vector2} from '../../math/Vector2.js';


function CubicBezierCurve(v0, v1, v2, v3) {

	Curve.call(this);

	this.type = 'CubicBezierCurve';

	this.v0 = v0 || new Vector2();
	this.v1 = v1 || new Vector2();
	this.v2 = v2 || new Vector2();
	this.v3 = v3 || new Vector2();

}

CubicBezierCurve.prototype = Object.create(Curve.prototype);
CubicBezierCurve.prototype.constructor = CubicBezierCurve;

CubicBezierCurve.prototype.isCubicBezierCurve = true;

CubicBezierCurve.prototype.getPoint = function (t, optionalTarget) {

	var point = optionalTarget || new Vector2();

	var v0 = this.v0, v1 = this.v1, v2 = this.v2, v3 = this.v3;

	point.set(
		CubicBezier(t, v0.x, v1.x, v2.x, v3.x),
		CubicBezier(t, v0.y, v1.y, v2.y, v3.y)
	);

	return point;

};

CubicBezierCurve.prototype.copy = function (source) {

	Curve.prototype.copy.call(this, source);

	this.v0.copy(source.v0);
	this.v1.copy(source.v1);
	this.v2.copy(source.v2);
	this.v3.copy(source.v3);

	return this;

};

CubicBezierCurve.prototype.toJSON = function () {

	var data = Curve.prototype.toJSON.call(this);

	data.v0 = this.v0.toArray();
	data.v1 = this.v1.toArray();
	data.v2 = this.v2.toArray();
	data.v3 = this.v3.toArray();

	return data;

};

CubicBezierCurve.prototype.fromJSON = function (json) {

	Curve.prototype.fromJSON.call(this, json);

	this.v0.fromArray(json.v0);
	this.v1.fromArray(json.v1);
	this.v2.fromArray(json.v2);
	this.v3.fromArray(json.v3);

	return this;

};


export {CubicBezierCurve};
