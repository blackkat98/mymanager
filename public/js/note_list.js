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
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
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
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 7);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/custom/note_list.js":
/*!******************************************!*\
  !*** ./resources/js/custom/note_list.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var listRoute = $('input#list-route').val();
var storeRoute = $('input#store-route').val();
var showRoute = $('input#show-route').val();
var updateRoute = $('input#update-route').val();
var deleteRoute = $('input#delete-route').val();
var csrfToken = $('input#csrf-token').val();
$(document).on('click', '#create-btn', function () {
  var data = new FormData($('#_create-form')[0]);
  $.ajax({
    url: storeRoute,
    type: 'POST',
    data: data,
    processData: false,
    contentType: false,
    success: function success(res) {
      if (res.status) {
        var data = res.data;
        var content = data.content;
        content = content.length > 15 ? content.substring(0, 16) + '...' : content;
        var note = "\n                    <div class=\"col-md-3\" id=\"note-".concat(data.id, "\">\n                        <div class=\"card\" style=\"").concat(data.style, "\">\n                            <div class=\"card-header\">\n                                <div class=\"card-tools float-right\">\n                                    <button id=\"edit-btn-").concat(data.id, "\" class=\"btn btn-xs\" data-toggle=\"modal\" data-target=\"#edit-form\">\n                                        <i class=\"fas fa-eye\"></i>\n                                    </button>\n                                    <button id=\"delete-btn-").concat(data.id, "\" class=\"btn btn-xs\">\n                                        <i class=\"fas fa-trash\"></i>\n                                    </button>\n                                </div>\n                            </div>\n                            <div class=\"card-body\">\n                                ").concat(content, "\n                            </div>\n                        </div>\n                    </div>\n                ");
        $('#note-list').prepend(note);
      }
    },
    error: function error(e) {
      console.log(e);
    }
  });
});
$(document).on('click', 'button[id^=edit-btn-]', function () {
  var noteId = this.id.replace('edit-btn-', '');
  var url = showRoute.slice(0, -1) + noteId;
  $.ajax({
    url: url,
    type: 'GET',
    success: function success(res) {
      if (res.status) {
        var style = res.data.style;
        style = style.replaceAll(/\s/g, '');
        style = style.split(';');
        var styles = {};
        style.forEach(function (s) {
          if (s) {
            var splitted = s.split(':');
            styles[splitted[0]] = splitted[1];
          }
        });
        $('#edit-form input#note-id').val(noteId);
        $('#edit-form textarea[name=content]').val(res.data.content);
        $('#edit-form input[name=color]').val(styles['color']);
        $('#edit-form input[name=background-color]').val(styles['background-color']);
        $('i#sqr-color').css('color', styles['color']);
        $('i#sqr-bg-color').css('color', styles['background-color']);
      } else {}
    },
    error: function error(e) {
      console.log(e);
    }
  });
});
$(document).on('click', 'button[id^=delete-btn-]', function () {
  var noteId = this.id.replace('delete-btn-', '');
  var url = deleteRoute.slice(0, -1) + noteId;
  $.ajax({
    url: url,
    type: 'POST',
    data: {
      _token: csrfToken
    },
    success: function success(res) {
      if (res.status) {
        $('#note-' + noteId).remove();
      } else {}
    },
    error: function error(e) {
      console.log(e);
    }
  });
});
$(document).on('click', '#edit-btn', function () {
  var noteId = $('#note-id').val();
  var url = updateRoute.slice(0, -1) + noteId;
  var data = new FormData($('#_edit-form')[0]);
  $.ajax({
    url: url,
    type: 'POST',
    data: data,
    processData: false,
    contentType: false,
    success: function success(res) {
      if (res.status) {
        var data = res.data;
        var content = data.content;
        content = content.length > 15 ? content.substring(0, 16) + '...' : content;
        var note = "\n                    <div class=\"col-md-3\" id=\"note-".concat(data.id, "\">\n                        <div class=\"card\" style=\"").concat(data.style, "\">\n                            <div class=\"card-header\">\n                                <div class=\"card-tools float-right\">\n                                    <button id=\"edit-btn-").concat(data.id, "\" class=\"btn btn-xs\" data-toggle=\"modal\" data-target=\"#edit-form\">\n                                        <i class=\"fas fa-eye\"></i>\n                                    </button>\n                                    <button id=\"delete-btn-").concat(data.id, "\" class=\"btn btn-xs\">\n                                        <i class=\"fas fa-trash\"></i>\n                                    </button>\n                                </div>\n                            </div>\n                            <div class=\"card-body\">\n                                ").concat(content, "\n                            </div>\n                        </div>\n                    </div>\n                ");
        $('#note-' + noteId).replaceWith(note);
      } else {}
    },
    error: function error(e) {
      console.log(e);
    }
  });
});

/***/ }),

/***/ 7:
/*!************************************************!*\
  !*** multi ./resources/js/custom/note_list.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! D:\codes\mymanager\resources\js\custom\note_list.js */"./resources/js/custom/note_list.js");


/***/ })

/******/ });