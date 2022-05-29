/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
var __webpack_exports__ = {};
/*!***************************************!*\
  !*** ./resources/js/jet-js-by-wyl.js ***!
  \***************************************/


function _typeof(obj) { "@babel/helpers - typeof"; return _typeof = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (obj) { return typeof obj; } : function (obj) { return obj && "function" == typeof Symbol && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }, _typeof(obj); }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); Object.defineProperty(Constructor, "prototype", { writable: false }); return Constructor; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

var WJet = /*#__PURE__*/function () {
  function WJet(selector) {
    _classCallCheck(this, WJet);

    _defineProperty(this, "selector", void 0);

    _defineProperty(this, "dom", void 0);

    if (_typeof(selector) === 'object' && selector.nodeType == 1) {
      this.selector = selector;
    }

    if (typeof selector === 'string' || _typeof(selector) instanceof String) {
      this.selectorString = selector;
      this.selector = document.querySelector(selector);
    }
  }

  _createClass(WJet, [{
    key: "WFor",
    value: function WFor(callback) {
      document.querySelectorAll(this.selectorString).forEach(function (el, index, array) {
        return callback({
          el: el,
          index: index,
          array: array
        });
      });
    }
  }, {
    key: "val",
    value: function val(_val) {
      if (_val == '' || _val) {
        this.selector.value = _val;
        return this;
      }

      return this.selector.value;
    }
  }, {
    key: "attr",
    value: function attr(atr) {
      var val = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : null;

      if (val) {
        this.selector.setAttribute(atr, val);
        return this;
      }

      this.selector.getAttribute(atr);
      return this;
    }
  }, {
    key: "hasClass",
    value: function hasClass(cls) {
      return this.selector.classList.contains(cls);
    }
  }, {
    key: "html",
    value: function html(val) {
      this.selector.innerHTML = val;
    }
  }, {
    key: "click",
    value: function click() {
      this.selector.click();
    }
  }, {
    key: "remove",
    value: function remove() {
      this.selector.remove();
    }
  }, {
    key: "addClass",
    value: function addClass(cls) {
      this.selector.classList.add(cls);
      return this;
    }
  }, {
    key: "on",
    value: function on(event, callback) {
      this.selector.addEventListener(event, function (event) {
        var target = event.target;
        callback({
          event: event,
          el: target,
          id: target.id,
          value: target.value,
          html: function html(val) {
            return target.innerHTML(val);
          },
          hasClass: function hasClass(cls) {
            return target.classList.contains(cls);
          },
          toggleClass: function toggleClass(cls) {
            return target.classList.toggle(cls);
          },
          addClass: function addClass(cls) {
            return target.classList.add(cls);
          },
          removeClass: function removeClass(cls) {
            return target.classList.remove(cls);
          },
          toggleAttr: function toggleAttr(name, val) {
            return target.getAttribute(name) ? target.removeAttribute(name) : target.setAttribute(name, val);
          }
        });
      });
    }
  }, {
    key: "toggleClass",
    value: function toggleClass(cls) {
      this.selector.classList.toggle(cls);
    }
  }, {
    key: "checked",
    value: function checked(condition) {
      this.selector.checked = condition;
    }
  }, {
    key: "attrRemove",
    value: function attrRemove(atr) {
      this.selector.removeAttribute(atr);
    }
  }]);

  return WJet;
}();

window.W = function (selector) {
  return new WJet(selector);
};

var Jet = /*#__PURE__*/function () {
  function Jet(promise) {
    _classCallCheck(this, Jet);

    this.promise = promise;
  }

  _createClass(Jet, [{
    key: "done",
    value: function done(callback) {
      this.promise = this.promise.then(function (res) {
        callback(res);
        return res.data;
      });
      return this;
    }
  }, {
    key: "fail",
    value: function fail(callback) {
      this.promise = this.promise["catch"](function (err) {
        return callback(err);
      });
    }
  }]);

  return Jet;
}();

WJet.get = function (url) {
  return new Jet(fetch(url).then(function (res) {
    if (res.ok) {
      return res.json();
    }

    throw res.status;
  }));
};
/******/ })()
;