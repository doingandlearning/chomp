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
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/css/app.css":
/*!*******************************!*\
  !*** ./resources/css/app.css ***!
  \*******************************/
/*! no static exports found */
/***/ (function(module, exports) {

// removed by extract-text-webpack-plugin

/***/ }),

/***/ "./resources/js/app.js":
/*!*****************************!*\
  !*** ./resources/js/app.js ***!
  \*****************************/
/*! no static exports found */
/***/ (function(module, exports) {

function trigger_attendance_update(element) {
  if (element[0].classList.contains("family_click")) {
    return;
  }

  var checkbox = $(this);
  checkbox.css("display", "none");
  var session_id = element.attr("session_id");
  var person_id = element.attr("person_id");
  var child = false;
  var adult = false;

  if (element[0].classList.contains("adult_click")) {
    adult = true;
  } else {
    child = true;
  }

  $.ajax({
    url: "/register",
    type: "POST",
    dataType: "json",
    // type of response data
    timeout: 1500,
    // timeout milliseconds
    data: {
      session_id: session_id,
      person_id: person_id,
      child: child,
      adult: adult,
      _token: $("#token").val()
    },
    success: function success(data, status, xhr) {
      // success callback function
      checkbox.css("display", "unset");
    },
    error: function error(jqXhr, textStatus, errorMessage) {
      // error callback
      alert("Error: " + errorMessage);
    }
  });
}

function update_adult_attendance(element) {
  var family_id = $(this).attr("family_id");
}

$(document).ready(function () {
  $(".family_click").click(function () {
    $(this).css("visibility", "hidden");

    if ($(this).prop("checked")) {
      $(this).closest("fieldset").find("input").prop("checked", true).each(function (e) {
        trigger_attendance_update($(this));
      });
    } else {
      $(this).closest("fieldset").find("input").prop("checked", false).each(function (e) {
        trigger_attendance_update($(this));
      });
    }
  });
  $(".adult_click").change(function () {
    $(this).closest("fieldset").find(".family_click").css("visibility", "hidden");
    trigger_attendance_update($(this));
  });
  $(".child_click").click(function () {
    $(this).closest("fieldset").find(".family_click").css("visibility", "hidden");
    trigger_attendance_update($(this));
  });
});
$(document).ready(function () {
  var postURL = "<?php echo url('addmore'); ?>";
  var i = 10;
  var j = 10;

  function childHTML(i) {
    return '<div id="divchild' + i + '"class="bg-grey-lighter shadow-md rounded px-8 pt-6 pb-8 mb-4">\n' + '          <div class="mb-4">\n' + '          <label class="text-gray-700" for="child[' + i + '][name]">Child name</label>\n' + '      <input class="form-input mt-1 block w-full" type="text" value="" class="form-control" id="child[' + i + '][name]" name="child[' + i + '][name]">\n' + "          </div>\n" + '          <div class="mb-4">\n' + '          <label class="text-gray-700" for="child[' + i + '][birthyear]">Year of birth</label>\n' + '      <input class="form-input mt-1 block w-full" type="text" value="" class="form-control" id="child[' + i + '][birthyear]" name="child[' + i + '][birthyear]">\n' + "          </div>\n" + '          <div class="mb-4">\n' + '          <label class="text-gray-700" for="child[' + i + '][special_requirements]">Additional Information (food, health, anything you think is important)</label>\n' + '      <textarea class="form-textarea mt-1 block w-full" rows="3" value="" class="form-control" id="child[' + i + '][special_requirements]" name="child[' + i + '][special_requirements]"></textarea>' + "          </div>\n" + '  <button type="button" class="text-red-400 btn_remove" id="child' + i + '">Remove Child</button>' + "          </div>";
  }

  function adultHTML(j) {
    return '<div id="divadult' + j + '" class="bg-grey-lighter shadow-md rounded px-8 pt-6 pb-8 mb-4">\n' + '          <div class="mb-4">\n' + '          <label class="text-gray-700" for="adult[' + j + '][name]">Adult name</label>\n' + '      <input class="form-input mt-1 block w-full" type="text" value="" class="form-control" id="adult[' + j + '][name]" name="adult[' + j + '][name]">\n' + "          </div>\n" + '  <button type="button" class="text-red-400 btn_remove" id="adult' + j + '">Remove Adult</button>' + "          </div>";
  }

  $("#addchild").click(function () {
    $("#children").append(childHTML(i));
    i++;
  });
  $("#addadult").click(function () {
    $("#extraadult").append(adultHTML(j));
    j++;
  });
  $(document).on("click", ".btn_remove", function () {
    var button_id = $(this).attr("id");
    $("#div" + button_id + "").remove();
  });
});

/***/ }),

/***/ 0:
/*!***********************************************************!*\
  !*** multi ./resources/js/app.js ./resources/css/app.css ***!
  \***********************************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

__webpack_require__(/*! /Users/kevin/code/chomp/resources/js/app.js */"./resources/js/app.js");
module.exports = __webpack_require__(/*! /Users/kevin/code/chomp/resources/css/app.css */"./resources/css/app.css");


/***/ })

/******/ });