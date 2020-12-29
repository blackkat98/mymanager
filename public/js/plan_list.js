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
/******/ 	return __webpack_require__(__webpack_require__.s = 9);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/custom/plan_list.js":
/*!******************************************!*\
  !*** ./resources/js/custom/plan_list.js ***!
  \******************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var listRoute = $('input#list-route').val();
var getRoute = $('input#get-route').val();
var storeRoute = $('input#store-route').val();
var showRoute = $('input#show-route').val();
var updateRoute = $('input#update-route').val();
var deleteRoute = $('input#delete-route').val();
var csrfToken = $('input#csrf-token').val();
var Calendar = FullCalendar.Calendar;
var calendarDiv = document.getElementById('calendar');
var calendar = new Calendar(calendarDiv, {
  plugins: ['bootstrap', 'interaction', 'dayGrid', 'timeGrid'],
  header: {
    left: 'prev,next today',
    center: 'title',
    right: 'dayGridMonth,timeGridWeek,timeGridDay'
  },
  themeSystem: 'bootstrap',
  events: [],
  editable: true,
  eventRender: function eventRender(event) {
    var fcContent = event.el.firstChild;
    fcContent.setAttribute('id', event.event.id);
  },
  eventDrop: function eventDrop(event) {
    var planId = event.event.id.replace('plan-event-', '');
    var url = updateRoute.slice(0, -1) + planId;
    $.ajax({
      url: url,
      type: 'POST',
      data: {
        _token: csrfToken,
        name: event.event.title,
        starts_at: moment(event.event.start).format('YYYY-MM-DD hh:mm:ss'),
        ends_at: moment(event.event.start).add(1, 'hours').format('YYYY-MM-DD hh:mm:ss'),
        color: event.event.backgroundColor
      },
      success: function success(res) {
        console.log(res.message);
        console.log(res.data);
      },
      error: function error(e) {
        console.log(e);
      }
    });
  }
});
calendar.render();
$.ajax({
  url: getRoute,
  type: 'GET',
  success: function success(res) {
    res.forEach(function (element) {
      var event = {
        id: 'plan-event-' + element.id,
        title: element.name,
        start: new Date(element.starts_at),
        end: new Date(element.ends_at),
        backgroundColor: element.style.replace('color: ', ''),
        borderColor: element.style.replace('color: ', '')
      };
      calendar.addEvent(event);
    });
  },
  error: function error(e) {
    console.log(e);
  }
});
$('.fc-color-picker.plan-create-color-picker .fa-square').on('click', function () {
  var color = $(this).css('color');
  $('input[name=color]').val(color);
  $('#create-btn').css('background-color', color);
  $('#color-sample').css('color', color);
});
$('.fc-color-picker.plan-edit-color-picker .fa-square').on('click', function () {
  var color = $(this).css('color');
  $('input#plan-color').val(color);
  $('#plan-color-sample').css('color', color);
});
$(document).on('click', '#create-btn', function (event) {
  event.preventDefault();
  var data = new FormData($('#create-form')[0]);
  $('input[name=name]').val('');
  $.ajax({
    url: storeRoute,
    type: 'POST',
    data: data,
    processData: false,
    contentType: false,
    success: function success(res) {
      var event = {
        id: 'plan-event-' + res.data.id,
        title: res.data.name,
        start: new Date(res.data.starts_at),
        end: new Date(res.data.ends_at),
        backgroundColor: res.data.style.replace('color: ', ''),
        borderColor: res.data.style.replace('color: ', '')
      };
      calendar.addEvent(event);
    },
    error: function error(e) {
      console.log(e);
    }
  });
});
$(document).on('dblclick', '.fc-content', function () {
  $('button#edit-btn').trigger('click');
  var elementId = this.id;
  var planId = elementId.replace('plan-event-', '');
  var url = showRoute.slice(0, -1) + planId;
  $.ajax({
    url: url,
    type: 'GET',
    success: function success(res) {
      $('input#plan-id').val(res.id);
      $('input#plan-name').val(res.name);
      $('input#plan-time').val(res.starts_at + ' - ' + res.ends_at);
      $('input#plan-color').val(res.style.replace('color: ', ''));
      $('#plan-color-sample').css('color', res.style.replace('color: ', ''));
    },
    error: function error(e) {
      console.log(e);
    }
  });
});
$(document).on('click', 'button#update-btn', function () {
  var planId = $('input#plan-id').val();
  var url = updateRoute.slice(0, -1) + planId;
  var name = $('input#plan-name').val();
  var timeRange = $('input#plan-time').val();
  var range = timeRange.split(' - ');
  var startTime = range[0];
  var endTime = range[1];
  var color = $('input#plan-color').val();
  $.ajax({
    url: url,
    type: 'POST',
    data: {
      _token: csrfToken,
      name: name,
      starts_at: startTime,
      ends_at: endTime,
      color: color
    },
    success: function success(res) {
      var eventContainer = calendar.getEventById('plan-event-' + planId);
      eventContainer.remove();
      var event = {
        id: 'plan-event-' + res.data.id,
        title: res.data.name,
        start: new Date(res.data.starts_at),
        end: new Date(res.data.ends_at),
        backgroundColor: res.data.style.replace('color: ', ''),
        borderColor: res.data.style.replace('color: ', '')
      };
      calendar.addEvent(event);
    },
    error: function error(e) {
      console.log(e);
    }
  });
});
$(document).on('click', 'button#delete-btn', function () {
  var planId = $('input#plan-id').val();
  var url = deleteRoute.slice(0, -1) + planId;
  $.ajax({
    url: url,
    type: 'POST',
    data: {
      _token: csrfToken
    },
    success: function success(res) {
      if (res.status) {
        var eventContainer = calendar.getEventById('plan-event-' + planId);
        eventContainer.remove();
      } else {
        console.log(res.message);
      }
    },
    error: function error(e) {
      console.log(e);
    }
  });
});

/***/ }),

/***/ 9:
/*!************************************************!*\
  !*** multi ./resources/js/custom/plan_list.js ***!
  \************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! D:\codes\mymanager\resources\js\custom\plan_list.js */"./resources/js/custom/plan_list.js");


/***/ })

/******/ });