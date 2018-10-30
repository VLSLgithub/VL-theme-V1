/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// identity function for calling harmony imports with the correct context
/******/ 	__webpack_require__.i = function(value) { return value; };
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 8);
/******/ })
/************************************************************************/
/******/ ({

/***/ 0:
/***/ (function(module, exports, __webpack_require__) {

"use strict";


(function (blocks, editor, i18n, element, components, compose, _) {

	var registerBlockType = blocks.registerBlockType,
	    G = components.G,
	    SVG = components.SVG,
	    Path = components.Path,
	    InnerBlocks = editor.InnerBlocks;

	registerBlockType('vibrant-life/column', {

		title: 'Column',

		parent: ['vibrant-life/columns'],

		icon: wp.element.createElement(
			SVG,
			{ xmlns: 'http://www.w3.org/2000/svg', viewBox: '0 0 24 24' },
			wp.element.createElement(Path, { fill: 'none', d: 'M0 0h24v24H0V0z' }),
			wp.element.createElement(Path, { d: 'M11.99 18.54l-7.37-5.73L3 14.07l9 7 9-7-1.63-1.27zM12 16l7.36-5.73L21 9l-9-7-9 7 1.63 1.27L12 16zm0-11.47L17.74 9 12 13.47 6.26 9 12 4.53z' })
		),

		description: 'A single column within a columns block.',

		attributes: {
			smallColumns: {
				type: 'number',
				default: 1
			},
			mediumColumns: {
				type: 'number',
				default: 2
			},
			largeColumns: {
				type: 'number',
				default: 2
			},
			xlargeColumns: {
				type: 'number',
				default: 2
			}
		},

		category: 'common',

		supports: {
			inserter: false
		},

		edit: function edit(_ref) {
			var attributes = _ref.attributes,
			    setAttributes = _ref.setAttributes,
			    className = _ref.className;
			var smallColumns = attributes.smallColumns,
			    mediumColumns = attributes.mediumColumns,
			    largeColumns = attributes.largeColumns,
			    xlargeColumns = attributes.xlargeColumns;


			return wp.element.createElement(
				'div',
				{ className: 'small-' + 12 / smallColumns + ' medium-' + 12 / mediumColumns + ' large-' + 12 / largeColumns + ' xlarge-' + 12 / xlargeColumns + ' columns' },
				wp.element.createElement(InnerBlocks, { templateLock: false })
			);
		},
		save: function save(_ref2) {
			var attributes = _ref2.attributes;
			var smallColumns = attributes.smallColumns,
			    mediumColumns = attributes.mediumColumns,
			    largeColumns = attributes.largeColumns,
			    xlargeColumns = attributes.xlargeColumns;


			return wp.element.createElement(
				'div',
				{ className: 'small-' + 12 / smallColumns + ' medium-' + 12 / mediumColumns + ' large-' + 12 / largeColumns + ' xlarge-' + 12 / xlargeColumns + ' columns' },
				wp.element.createElement(InnerBlocks.Content, null)
			);
		}
	});
})(window.wp.blocks, window.wp.editor, window.wp.i18n, window.wp.element, window.wp.components, window.wp.compose, window._);

/***/ }),

/***/ 8:
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(0);


/***/ })

/******/ });