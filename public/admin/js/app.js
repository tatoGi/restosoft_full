/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/admin/js/app.js":
/*!***********************************!*\
  !*** ./resources/admin/js/app.js ***!
  \***********************************/
/***/ (function(__unused_webpack_module, __unused_webpack_exports, __webpack_require__) {

var _this2 = this;

__webpack_require__(Object(function webpackMissingModule() { var e = new Error("Cannot find module './bootstrap'"); e.code = 'MODULE_NOT_FOUND'; throw e; }()));

Vue.component('chat-messages', __webpack_require__(Object(function webpackMissingModule() { var e = new Error("Cannot find module '.assets/js/components/ChatMessages.vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())));
Vue.component('chat-form', __webpack_require__(Object(function webpackMissingModule() { var e = new Error("Cannot find module '.assets/js/components/ChatForm.vue'"); e.code = 'MODULE_NOT_FOUND'; throw e; }())));
var app = new Vue({
  el: '#app',
  data: {
    messages: []
  },
  created: function created() {
    this.fetchMessages();
  },
  methods: {
    fetchMessages: function fetchMessages() {
      var _this = this;

      axios.get('/messages').then(function (response) {
        _this.messages = response.data;
      });
    },
    addMessage: function addMessage(message) {
      this.messages.push(message);
      axios.post('/messages', message).then(function (response) {
        console.log(response.data);
      });
    }
  }
});
Echo["private"]('chat').listen('MessageSent', function (e) {
  _this2.messages.push({
    message: e.message.message,
    user: e.user
  });
});

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
/******/ 		__webpack_modules__[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module is referenced by other modules so it can't be inlined
/******/ 	var __webpack_exports__ = __webpack_require__("./resources/admin/js/app.js");
/******/ 	
/******/ })()
;