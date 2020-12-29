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

/***/ "./resources/js/custom/calendar.js":
/*!*****************************************!*\
  !*** ./resources/js/custom/calendar.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

$(function () {
  /* initialize the external events
   -----------------------------------------------------------------*/
  function ini_events(ele) {
    ele.each(function () {
      // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
      // it doesn't need to have a start or end
      var eventObject = {
        title: $.trim($(this).text()) // use the element's text as the event title

      }; // store the Event Object in the DOM element so we can get to it later

      $(this).data('eventObject', eventObject); // make the event draggable using jQuery UI
      // $(this).draggable({
      //     zIndex        : 1070,
      //     revert        : true, // will cause the event to go back to its
      //     revertDuration: 0  //  original position after the drag
      // })
    });
  }

  ini_events($('#external-events div.external-event'));
  /* initialize the calendar
   -----------------------------------------------------------------*/
  //Date for the calendar events (dummy data)

  var date = new Date();
  var d = date.getDate(),
      m = date.getMonth(),
      y = date.getFullYear();
  var Calendar = FullCalendar.Calendar;
  var Draggable = FullCalendarInteraction.Draggable;
  var containerEl = document.getElementById('external-events');
  var checkbox = document.getElementById('drop-remove');
  var calendarEl = document.getElementById('calendar'); // initialize the external events
  // -----------------------------------------------------------------

  new Draggable(containerEl, {
    itemSelector: '.external-event',
    eventData: function eventData(eventEl) {
      console.log(eventEl);
      return {
        title: eventEl.innerText,
        backgroundColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
        borderColor: window.getComputedStyle(eventEl, null).getPropertyValue('background-color'),
        textColor: window.getComputedStyle(eventEl, null).getPropertyValue('color')
      };
    }
  });
  var calendar = new Calendar(calendarEl, {
    plugins: ['bootstrap', 'interaction', 'dayGrid', 'timeGrid'],
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'dayGridMonth,timeGridWeek,timeGridDay'
    },
    'themeSystem': 'bootstrap',
    //Random default events
    events: [{
      title: 'All Day Event',
      start: new Date(y, m, 1),
      backgroundColor: '#f56954',
      //red
      borderColor: '#f56954',
      //red
      allDay: true
    }, {
      title: 'Long Event',
      start: new Date(y, m, d - 5),
      end: new Date(y, m, d - 2),
      backgroundColor: '#f39c12',
      //yellow
      borderColor: '#f39c12' //yellow

    }, {
      title: 'Meeting',
      start: new Date(y, m, d, 10, 30),
      allDay: false,
      backgroundColor: '#0073b7',
      //Blue
      borderColor: '#0073b7' //Blue

    }, {
      title: 'Lunch',
      start: new Date(y, m, d, 12, 0),
      end: new Date(y, m, d, 14, 0),
      allDay: false,
      backgroundColor: '#00c0ef',
      //Info (aqua)
      borderColor: '#00c0ef' //Info (aqua)

    }, {
      title: 'Birthday Party',
      start: new Date(y, m, d + 1, 19, 0),
      end: new Date(y, m, d + 1, 22, 30),
      allDay: false,
      backgroundColor: '#00a65a',
      //Success (green)
      borderColor: '#00a65a' //Success (green)

    }, {
      title: 'Click for Google',
      start: new Date(y, m, 28),
      end: new Date(y, m, 29),
      url: 'http://google.com/',
      backgroundColor: '#3c8dbc',
      //Primary (light-blue)
      borderColor: '#3c8dbc' //Primary (light-blue)

    }],
    editable: true,
    droppable: true,
    // this allows things to be dropped onto the calendar !!!
    drop: function drop(info) {
      // is the "remove after drop" checkbox checked?
      if (checkbox.checked) {
        // if so, remove the element from the "Draggable Events" list
        info.draggedEl.parentNode.removeChild(info.draggedEl);
      }
    }
  });
  calendar.render(); // $('#calendar').fullCalendar()

  /* ADDING EVENTS */

  var currColor = '#3c8dbc'; //Red by default
  //Color chooser button

  var colorChooser = $('#color-chooser-btn');
  $('#color-chooser > li > a').click(function (e) {
    e.preventDefault(); //Save color

    currColor = $(this).css('color'); //Add color effect to button

    $('#add-new-event').css({
      'background-color': currColor,
      'border-color': currColor
    });
  });
  $('#add-new-event').click(function (e) {
    e.preventDefault(); //Get value and make sure it is not null

    var val = $('#new-event').val();

    if (val.length == 0) {
      return;
    } //Create events


    var event = $('<div />');
    event.css({
      'background-color': currColor,
      'border-color': currColor,
      'color': '#fff'
    }).addClass('external-event');
    event.html(val);
    $('#external-events').prepend(event); //Add draggable funtionality

    ini_events(event); //Remove event from text input

    $('#new-event').val('');
  });
});

/***/ }),

/***/ 7:
/*!***********************************************!*\
  !*** multi ./resources/js/custom/calendar.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! D:\codes\mymanager\resources\js\custom\calendar.js */"./resources/js/custom/calendar.js");


/***/ })

/******/ });