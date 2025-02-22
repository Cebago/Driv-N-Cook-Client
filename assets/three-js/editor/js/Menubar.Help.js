/**
 * @author mrdoob / http://mrdoob.com/
 */

import {UIPanel, UIRow} from './libs/ui.js';

var MenubarHelp = function (editor) {

	var strings = editor.strings;

	var container = new UIPanel();
	container.setClass('menu');

	var title = new UIPanel();
	title.setClass('title');
	title.setTextContent(strings.getKey('menubar/help'));
	container.add(title);

	var options = new UIPanel();
	options.setClass('options');
	container.add(options);

	// Source code

	var option = new UIRow();
	option.setClass('option');
	option.setTextContent(strings.getKey('menubar/help/source_code'));
	option.onClick(function () {

		window.open('https://github.com/mrdoob/three.js/tree/master/editor', '_blank');

	});
	options.add(option);

	// About

	var option = new UIRow();
	option.setClass('option');
	option.setTextContent(strings.getKey('menubar/help/about'));
	option.onClick(function () {

		window.open('http://threejs.org', '_blank');

	});
	options.add(option);

	return container;

};

export {MenubarHelp};
