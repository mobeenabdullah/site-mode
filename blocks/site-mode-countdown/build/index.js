/******/ (function() { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./constants.js":
/*!**********************!*\
  !*** ./constants.js ***!
  \**********************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   layouts: function() { return /* binding */ layouts; },
/* harmony export */   presetSettings: function() { return /* binding */ presetSettings; }
/* harmony export */ });
const layouts = [{
  'label': 'Preset 1',
  'value': 'default-countdown'
}, {
  'label': 'Preset 2',
  'value': 'countdown-without-box'
}, {
  'label': 'Preset 3',
  'value': 'countdown-individual-shadow'
}, {
  'label': 'Preset 4',
  'value': 'countdown-box-shadow'
}, {
  'label': 'Preset 5',
  'value': 'countdown-column'
}, {
  'label': 'Preset 6',
  'value': 'countdown-with-simple-seperator'
}, {
  'label': 'Preset 7',
  'value': 'countdown-in-row'
}, {
  'label': 'Preset 8',
  'value': 'countdown-in-row-individual'
}, {
  'label': 'Preset 9',
  'value': 'countdown-flat'
}, {
  'label': 'Preset 10',
  'value': 'countdown-circle'
}];
const presetSettings = {
  'default-countdown': {
    bgColor: '#ffffff',
    borderColor: '#ffffff',
    timerColor: '#000000',
    labelColor: '#000000',
    separatorColor: '#ffffff'
  },
  'countdown-without-box': {
    bgColor: '#ffffff',
    borderColor: '#ffffff',
    timerColor: '#000000',
    labelColor: '#000000',
    separatorColor: '#ffffff'
  },
  'countdown-individual-shadow': {
    bgColor: '#ffffff',
    borderColor: '#ffffff',
    timerColor: '#000000',
    labelColor: '#000000',
    separatorColor: '#ffffff'
  },
  'countdown-box-shadow': {
    bgColor: '#ffffff',
    borderColor: '#ffffff',
    timerColor: '#000000',
    labelColor: '#000000',
    separatorColor: '#ffffff'
  },
  'countdown-with-simple-seperator': {
    bgColor: '#ffffff',
    borderColor: '#ffffff',
    timerColor: '#000000',
    labelColor: '#000000',
    separatorColor: '#ffffff'
  },
  'countdown-in-row-individual': {
    bgColor: '#ffffff',
    borderColor: '#ffffff',
    timerColor: '#000000',
    labelColor: '#000000',
    separatorColor: '#ffffff'
  },
  'countdown-flat': {
    bgColor: '#ffffff',
    borderColor: '#ffffff',
    timerColor: '#000000',
    labelColor: '#000000',
    separatorColor: '#ffffff'
  },
  'countdown-column': {
    bgColor: '#ffffff',
    borderColor: '#ffffff',
    timerColor: '#000000',
    labelColor: '#000000',
    separatorColor: '#ffffff'
  },
  'countdown-in-row': {
    bgColor: '#ffffff',
    borderColor: '#ffffff',
    timerColor: '#000000',
    labelColor: '#000000',
    separatorColor: '#ffffff'
  },
  'countdown-circle': {
    bgColor: '#ffffff',
    borderColor: '#ffffff',
    timerColor: '#000000',
    labelColor: '#000000',
    separatorColor: '#ffffff'
  }
};

/***/ }),

/***/ "./src/edit.js":
/*!*********************!*\
  !*** ./src/edit.js ***!
  \*********************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ Edit; }
/* harmony export */ });
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/element */ "@wordpress/element");
/* harmony import */ var _wordpress_element__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! @wordpress/i18n */ "@wordpress/i18n");
/* harmony import */ var _wordpress_i18n__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! @wordpress/block-editor */ "@wordpress/block-editor");
/* harmony import */ var _wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__);
/* harmony import */ var _constants__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ../constants */ "./constants.js");
/* harmony import */ var _editor_scss__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./editor.scss */ "./src/editor.scss");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! @wordpress/components */ "@wordpress/components");
/* harmony import */ var _wordpress_components__WEBPACK_IMPORTED_MODULE_5___default = /*#__PURE__*/__webpack_require__.n(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__);







function Edit(_ref) {
  let {
    attributes,
    setAttributes
  } = _ref;
  const {
    dueDate,
    showLabel,
    showDays,
    showHours,
    showMinutes,
    showSeconds,
    showSeperator,
    preset,
    labels,
    bgColor,
    timerColor,
    labelColor,
    borderColor,
    separatorColor,
    numberFontSize,
    labelFontSize
  } = attributes;
  const [isInvalidDate, setIsInvalidDate] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.useState)(false);
  const [days, setDays] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.useState)();
  const [hours, setHours] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.useState)();
  const [minutes, setMinutes] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.useState)();
  const [seconds, setSeconds] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.useState)();
  const [intervalCount, setIntervalCount] = (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.useState)();
  (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.useEffect)(() => {
    if (dueDate) {
      clearInterval(intervalCount);
      const interval = setInterval(countdownHandler, 1000);
      setIntervalCount(interval);
    } else {
      clearInterval(intervalCount);
      setIntervalCount(null);
    }
  }, [dueDate, showSeconds, showMinutes, showHours, showDays]);
  function countdownHandler() {
    const now = new Date();
    const nowUTC = new Date(now.getUTCFullYear(), now.getUTCMonth(), now.getUTCDate(), now.getUTCHours(), now.getUTCMinutes(), now.getUTCSeconds());
    const end = new Date(dueDate);
    const endUTC = new Date(end.getUTCFullYear(), end.getUTCMonth(), end.getUTCDate(), end.getUTCHours(), end.getUTCMinutes(), end.getUTCSeconds());
    const timeleft = endUTC - nowUTC;
    let smDays = Math.floor(timeleft / (1000 * 60 * 60 * 24));
    let smHours = Math.floor(timeleft % (1000 * 60 * 60 * 24) / (1000 * 60 * 60));
    let smMinutes = Math.floor(timeleft % (1000 * 60 * 60) / (1000 * 60));
    let smSeconds = Math.floor(timeleft % (1000 * 60) / 1000);
    if (!showDays) {
      smHours = smHours + smDays * 24;
      smDays = 0;
    }
    if (!showHours) {
      smMinutes = smMinutes + smHours * 60;
      smHours = 0;
    }
    if (!showMinutes) {
      smSeconds = smSeconds + smMinutes * 60;
      smMinutes = 0;
    }
    if (!showSeconds) {
      smSeconds = 0;
    }
    if (smSeconds > 0 || smDays > 0 || smHours > 0 || smMinutes > 0) {
      setDays(smDays);
      setHours(smHours);
      setMinutes(smMinutes);
      setSeconds(smSeconds);
    } else {
      setDays(0);
      setHours(0);
      setMinutes(0);
      setSeconds(0);
      clearInterval(intervalCount);
      setIntervalCount(null);
    }
  }
  const onChangeDate = newDate => {
    const now = new Date();
    const nowUTC = new Date(now.getUTCFullYear(), now.getUTCMonth(), now.getUTCDate(), now.getUTCHours(), now.getUTCMinutes(), now.getUTCSeconds());
    if (new Date(newDate) < nowUTC) {
      setIsInvalidDate(true);
      setAttributes({
        dueDate: ''
      });
    } else {
      setIsInvalidDate(false);
      setAttributes({
        dueDate: newDate
      });
    }
  };
  const handlePresetChange = value => {
    const presetNewSettings = {
      'bgColor': _constants__WEBPACK_IMPORTED_MODULE_3__.presetSettings[value].bgColor,
      'timerColor': _constants__WEBPACK_IMPORTED_MODULE_3__.presetSettings[value].timerColor,
      'labelColor': _constants__WEBPACK_IMPORTED_MODULE_3__.presetSettings[value].labelColor,
      'borderColor': _constants__WEBPACK_IMPORTED_MODULE_3__.presetSettings[value].borderColor,
      'separatorColor': _constants__WEBPACK_IMPORTED_MODULE_3__.presetSettings[value].separatorColor,
      'preset': value
    };
    setAttributes({
      ...presetNewSettings
    });
  };
  const smCounterBox = {
    backgroundColor: bgColor,
    borderColor: borderColor
  };
  const smCountdownDaysLabel = {
    color: labelColor,
    fontSize: labelFontSize
  };
  const countdownNumber = {
    color: timerColor,
    fontSize: numberFontSize
  };
  const countdownSeperator = {
    color: separatorColor
  };
  return (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__.InspectorControls, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.PanelBody, {
    title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Settings', 'site-mode'),
    initialOpen: false
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.PanelRow, null, isInvalidDate && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("p", {
    className: "error-message"
  }, (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Please select a date in the future.', 'site-mode')), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.DateTimePicker, {
    currentDate: dueDate,
    onChange: onChangeDate,
    is12Hour: true
  }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.PanelBody, {
    title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Layout', 'site-mode'),
    initialOpen: false
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.PanelRow, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.SelectControl, {
    label: "Presets",
    value: preset,
    onChange: handlePresetChange,
    options: _constants__WEBPACK_IMPORTED_MODULE_3__.layouts
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.PanelRow, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.ToggleControl, {
    label: "Show Label",
    checked: showLabel,
    onChange: () => setAttributes({
      showLabel: !showLabel
    })
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.PanelRow, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.ToggleControl, {
    label: "Show Days",
    checked: showDays,
    onChange: () => setAttributes({
      showDays: !showDays
    })
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.PanelRow, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.ToggleControl, {
    label: "Show Hours",
    checked: showHours,
    onChange: () => setAttributes({
      showHours: !showHours
    })
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.PanelRow, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.ToggleControl, {
    label: "Show Minutes",
    checked: showMinutes,
    onChange: () => setAttributes({
      showMinutes: !showMinutes
    })
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.PanelRow, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.ToggleControl, {
    label: "Show Seconds",
    checked: showSeconds,
    onChange: () => setAttributes({
      showSeconds: !showSeconds
    })
  })), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.PanelRow, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.ToggleControl, {
    label: "Show Seperator",
    checked: showSeperator,
    onChange: () => setAttributes({
      showSeperator: !showSeperator
    })
  })), showDays && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.PanelRow, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.TextControl, {
    label: "Days Label",
    value: labels.days,
    onChange: value => setAttributes({
      labels: {
        ...labels,
        days: value
      }
    })
  })), showHours && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.PanelRow, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.TextControl, {
    label: "Hours Label",
    value: labels.hours,
    onChange: value => setAttributes({
      labels: {
        ...labels,
        hours: value
      }
    })
  })), showMinutes && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.PanelRow, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.TextControl, {
    label: "Minutes Label",
    value: labels.minutes,
    onChange: value => setAttributes({
      labels: {
        ...labels,
        minutes: value
      }
    })
  })), showSeconds && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.PanelRow, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.TextControl, {
    label: "Seconds Label",
    value: labels.seconds,
    onChange: value => setAttributes({
      labels: {
        ...labels,
        seconds: value
      }
    })
  }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.PanelBody, {
    title: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Styles', 'site-mode'),
    initialOpen: false
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__.PanelColorSettings, {
    title: "Color Settings",
    initialOpen: true,
    icon: "admin-appearance",
    colorSettings: [{
      value: bgColor,
      onChange: value => setAttributes({
        bgColor: value
      }),
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Background Color')
    }, {
      value: labelColor,
      onChange: value => setAttributes({
        labelColor: value
      }),
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Label Color')
    }, {
      value: borderColor,
      onChange: value => setAttributes({
        borderColor: value
      }),
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Border Color')
    }, {
      value: timerColor,
      onChange: value => setAttributes({
        timerColor: value
      }),
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Time Color')
    }, {
      value: separatorColor,
      onChange: value => setAttributes({
        separatorColor: value
      }),
      label: (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)('Separator Color')
    }]
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.__experimentalUnitControl, {
    label: "Font Size Counter",
    value: numberFontSize,
    onChange: value => setAttributes({
      numberFontSize: value
    })
  }), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_components__WEBPACK_IMPORTED_MODULE_5__.__experimentalUnitControl, {
    label: "Font Sie Label",
    value: labelFontSize,
    onChange: value => setAttributes({
      labelFontSize: value
    })
  }))), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", (0,_wordpress_block_editor__WEBPACK_IMPORTED_MODULE_2__.useBlockProps)(), dueDate && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)(_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.Fragment, null, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "countdown_main-wrapper"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: `countdown-wrapper ${preset}`
  }, showDays && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "sm-countdown-box sm-countdown-days-wrapper",
    style: smCounterBox
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "sm-countdown-days-label countdown_label",
    style: smCountdownDaysLabel
  }, showLabel && (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)(labels.days, 'site-mode')), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "sm-countdown-days countdown_number"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    style: countdownNumber
  }, days))), showSeperator && showDays && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "countdown-seperator",
    style: countdownSeperator
  }, ":"), showHours && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "sm-countdown-box sm-countdown-days-wrapper",
    style: smCounterBox
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "sm-countdown-days-label countdown_label",
    style: smCountdownDaysLabel
  }, showLabel && (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)(labels.hours, 'site-mode')), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "sm-countdown-days countdown_number"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    style: countdownNumber
  }, hours))), showSeperator && showHours && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "countdown-seperator",
    style: countdownSeperator
  }, ":"), showMinutes && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "sm-countdown-box sm-countdown-hours-wrapper",
    style: smCounterBox
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "sm-countdown-hours-label countdown_label",
    style: smCountdownDaysLabel
  }, showLabel && (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)(labels.minutes, 'site-mode')), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "sm-countdown-hours countdown_number"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    style: countdownNumber
  }, minutes))), showSeperator && showMinutes && showSeconds && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    className: "countdown-seperator",
    style: countdownSeperator
  }, ":"), showSeconds && (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "sm-countdown-box sm-countdown-minutes-wrapper",
    style: smCounterBox
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "sm-countdown-minutes-label countdown_label",
    style: smCountdownDaysLabel
  }, showLabel && (0,_wordpress_i18n__WEBPACK_IMPORTED_MODULE_1__.__)(labels.seconds, 'site-mode')), (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("div", {
    className: "sm-countdown-minutes countdown_number"
  }, (0,_wordpress_element__WEBPACK_IMPORTED_MODULE_0__.createElement)("span", {
    style: countdownNumber
  }, seconds))))))));
}

/***/ }),

/***/ "./src/index.js":
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @wordpress/blocks */ "@wordpress/blocks");
/* harmony import */ var _wordpress_blocks__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _style_scss__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./style.scss */ "./src/style.scss");
/* harmony import */ var _edit__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./edit */ "./src/edit.js");
/* harmony import */ var _save__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./save */ "./src/save.js");




(0,_wordpress_blocks__WEBPACK_IMPORTED_MODULE_0__.registerBlockType)('site-mode/countdown', {
  edit: _edit__WEBPACK_IMPORTED_MODULE_2__["default"],
  save: _save__WEBPACK_IMPORTED_MODULE_3__["default"]
});

/***/ }),

/***/ "./src/save.js":
/*!*********************!*\
  !*** ./src/save.js ***!
  \*********************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": function() { return /* binding */ save; }
/* harmony export */ });
function save() {
  return null;
}

/***/ }),

/***/ "./src/editor.scss":
/*!*************************!*\
  !*** ./src/editor.scss ***!
  \*************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "./src/style.scss":
/*!************************!*\
  !*** ./src/style.scss ***!
  \************************/
/***/ (function(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
// extracted by mini-css-extract-plugin


/***/ }),

/***/ "@wordpress/block-editor":
/*!*************************************!*\
  !*** external ["wp","blockEditor"] ***!
  \*************************************/
/***/ (function(module) {

module.exports = window["wp"]["blockEditor"];

/***/ }),

/***/ "@wordpress/blocks":
/*!********************************!*\
  !*** external ["wp","blocks"] ***!
  \********************************/
/***/ (function(module) {

module.exports = window["wp"]["blocks"];

/***/ }),

/***/ "@wordpress/components":
/*!************************************!*\
  !*** external ["wp","components"] ***!
  \************************************/
/***/ (function(module) {

module.exports = window["wp"]["components"];

/***/ }),

/***/ "@wordpress/element":
/*!*********************************!*\
  !*** external ["wp","element"] ***!
  \*********************************/
/***/ (function(module) {

module.exports = window["wp"]["element"];

/***/ }),

/***/ "@wordpress/i18n":
/*!******************************!*\
  !*** external ["wp","i18n"] ***!
  \******************************/
/***/ (function(module) {

module.exports = window["wp"]["i18n"];

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = __webpack_modules__;
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/chunk loaded */
/******/ 	!function() {
/******/ 		var deferred = [];
/******/ 		__webpack_require__.O = function(result, chunkIds, fn, priority) {
/******/ 			if(chunkIds) {
/******/ 				priority = priority || 0;
/******/ 				for(var i = deferred.length; i > 0 && deferred[i - 1][2] > priority; i--) deferred[i] = deferred[i - 1];
/******/ 				deferred[i] = [chunkIds, fn, priority];
/******/ 				return;
/******/ 			}
/******/ 			var notFulfilled = Infinity;
/******/ 			for (var i = 0; i < deferred.length; i++) {
/******/ 				var chunkIds = deferred[i][0];
/******/ 				var fn = deferred[i][1];
/******/ 				var priority = deferred[i][2];
/******/ 				var fulfilled = true;
/******/ 				for (var j = 0; j < chunkIds.length; j++) {
/******/ 					if ((priority & 1 === 0 || notFulfilled >= priority) && Object.keys(__webpack_require__.O).every(function(key) { return __webpack_require__.O[key](chunkIds[j]); })) {
/******/ 						chunkIds.splice(j--, 1);
/******/ 					} else {
/******/ 						fulfilled = false;
/******/ 						if(priority < notFulfilled) notFulfilled = priority;
/******/ 					}
/******/ 				}
/******/ 				if(fulfilled) {
/******/ 					deferred.splice(i--, 1)
/******/ 					var r = fn();
/******/ 					if (r !== undefined) result = r;
/******/ 				}
/******/ 			}
/******/ 			return result;
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	!function() {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = function(module) {
/******/ 			var getter = module && module.__esModule ?
/******/ 				function() { return module['default']; } :
/******/ 				function() { return module; };
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	!function() {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = function(exports, definition) {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	!function() {
/******/ 		__webpack_require__.o = function(obj, prop) { return Object.prototype.hasOwnProperty.call(obj, prop); }
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	!function() {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = function(exports) {
/******/ 			if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/jsonp chunk loading */
/******/ 	!function() {
/******/ 		// no baseURI
/******/ 		
/******/ 		// object to store loaded and loading chunks
/******/ 		// undefined = chunk not loaded, null = chunk preloaded/prefetched
/******/ 		// [resolve, reject, Promise] = chunk loading, 0 = chunk loaded
/******/ 		var installedChunks = {
/******/ 			"index": 0,
/******/ 			"style-index": 0
/******/ 		};
/******/ 		
/******/ 		// no chunk on demand loading
/******/ 		
/******/ 		// no prefetching
/******/ 		
/******/ 		// no preloaded
/******/ 		
/******/ 		// no HMR
/******/ 		
/******/ 		// no HMR manifest
/******/ 		
/******/ 		__webpack_require__.O.j = function(chunkId) { return installedChunks[chunkId] === 0; };
/******/ 		
/******/ 		// install a JSONP callback for chunk loading
/******/ 		var webpackJsonpCallback = function(parentChunkLoadingFunction, data) {
/******/ 			var chunkIds = data[0];
/******/ 			var moreModules = data[1];
/******/ 			var runtime = data[2];
/******/ 			// add "moreModules" to the modules object,
/******/ 			// then flag all "chunkIds" as loaded and fire callback
/******/ 			var moduleId, chunkId, i = 0;
/******/ 			if(chunkIds.some(function(id) { return installedChunks[id] !== 0; })) {
/******/ 				for(moduleId in moreModules) {
/******/ 					if(__webpack_require__.o(moreModules, moduleId)) {
/******/ 						__webpack_require__.m[moduleId] = moreModules[moduleId];
/******/ 					}
/******/ 				}
/******/ 				if(runtime) var result = runtime(__webpack_require__);
/******/ 			}
/******/ 			if(parentChunkLoadingFunction) parentChunkLoadingFunction(data);
/******/ 			for(;i < chunkIds.length; i++) {
/******/ 				chunkId = chunkIds[i];
/******/ 				if(__webpack_require__.o(installedChunks, chunkId) && installedChunks[chunkId]) {
/******/ 					installedChunks[chunkId][0]();
/******/ 				}
/******/ 				installedChunks[chunkId] = 0;
/******/ 			}
/******/ 			return __webpack_require__.O(result);
/******/ 		}
/******/ 		
/******/ 		var chunkLoadingGlobal = self["webpackChunksite_mode_countdown"] = self["webpackChunksite_mode_countdown"] || [];
/******/ 		chunkLoadingGlobal.forEach(webpackJsonpCallback.bind(null, 0));
/******/ 		chunkLoadingGlobal.push = webpackJsonpCallback.bind(null, chunkLoadingGlobal.push.bind(chunkLoadingGlobal));
/******/ 	}();
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module depends on other loaded chunks and execution need to be delayed
/******/ 	var __webpack_exports__ = __webpack_require__.O(undefined, ["style-index"], function() { return __webpack_require__("./src/index.js"); })
/******/ 	__webpack_exports__ = __webpack_require__.O(__webpack_exports__);
/******/ 	
/******/ })()
;
//# sourceMappingURL=index.js.map