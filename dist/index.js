/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};

/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {

/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;

/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			exports: {},
/******/ 			id: moduleId,
/******/ 			loaded: false
/******/ 		};

/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);

/******/ 		// Flag the module as loaded
/******/ 		module.loaded = true;

/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}


/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;

/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;

/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/dist/";

/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ function(module, exports, __webpack_require__) {

	module.exports = __webpack_require__(1);


/***/ },
/* 1 */
/***/ function(module, exports, __webpack_require__) {

	'use strict';

	__webpack_require__(2);

	var _index = __webpack_require__(3);

	var _index2 = _interopRequireDefault(_index);

	function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

	(function () {
	  return (0, _index2.default)();
	})();

/***/ },
/* 2 */
/***/ function(module, exports) {

	// removed by extract-text-webpack-plugin

/***/ },
/* 3 */
/***/ function(module, exports, __webpack_require__) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
	    value: true
	});
	exports.default = init;

	var _background = __webpack_require__(4);

	var _background2 = _interopRequireDefault(_background);

	var _header = __webpack_require__(5);

	var _file = __webpack_require__(6);

	var _date = __webpack_require__(7);

	var _address = __webpack_require__(8);

	function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }

	function bindHandlers() {
	    window.addEventListener('resize', _background2.default);
	    window.addEventListener('scroll', function () {
	        (0, _header.stickyHeader)();
	        (0, _background2.default)();
	    });
	    var menuButton = document.querySelector('.menu-button');
	    menuButton.addEventListener('click', _header.toggleMenu, false);

	    var fileInput = document.querySelector('.form-input-file');
	    if (fileInput) fileInput.addEventListener('change', _file.filePicker, false);

	    var dateInput = document.querySelector('.form-input-date');
	    if (dateInput) dateInput.setAttribute('min', (0, _date.setMinimumDate)());

	    var collectionInput = document.querySelector('.collection-method');
	    if (collectionInput) collectionInput.addEventListener('change', _address.toggleAddressFields, false);
	}

	function init() {
	    bindHandlers();
	    (0, _background2.default)();
	}

/***/ },
/* 4 */
/***/ function(module, exports) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
	    value: true
	});
	exports.default = setBackgroundHeight;
	function setBackgroundHeight() {
	    var background = document.querySelector('.background');
	    background.style.height = document.documentElement.offsetHeight + 'px';
	}

/***/ },
/* 5 */
/***/ function(module, exports) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
	    value: true
	});
	exports.stickyHeader = stickyHeader;
	exports.toggleMenu = toggleMenu;
	function stickyHeader() {
	    var scroll = window.scrollY;
	    var html = document.documentElement;

	    if (scroll > 0) {
	        html.classList.add('is-sticky');
	    } else {
	        html.classList.remove('is-sticky');
	    }
	}

	function toggleMenu(e) {
	    e.preventDefault();

	    var html = document.documentElement;
	    var menuButton = document.querySelector('.menu-button');

	    html.classList.toggle('menu-visible');
	}

/***/ },
/* 6 */
/***/ function(module, exports) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
	    value: true
	});
	exports.filePicker = filePicker;
	function filePicker(e) {
	    var value = e.target.value;

	    var element = e.target.parentElement;
	    var path = value.split('\\');
	    var filename = path[path.length - 1];

	    element.setAttribute('data-file', filename);
	}

/***/ },
/* 7 */
/***/ function(module, exports) {

	"use strict";

	Object.defineProperty(exports, "__esModule", {
	    value: true
	});
	exports.setMinimumDate = setMinimumDate;
	function setMinimumDate() {
	    var minLeadTime = arguments.length <= 0 || arguments[0] === undefined ? 1 : arguments[0];

	    var now = new Date();
	    var minDate = new Date(now.setDate(now.getDate() + minLeadTime));
	    return minDate.toISOString().substr(0, 10);
	}

/***/ },
/* 8 */
/***/ function(module, exports) {

	'use strict';

	Object.defineProperty(exports, "__esModule", {
	    value: true
	});
	exports.toggleAddressFields = toggleAddressFields;
	function toggleAddressFields(e) {
	    var addressFields = document.querySelector('.address-fields');
	    if (e.target.value === 'post') {
	        addressFields.style.display = 'initial';
	    } else {
	        addressFields.style.display = 'none';
	    }
	}

/***/ }
/******/ ]);