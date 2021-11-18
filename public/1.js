(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[1],{

/***/ "./resources/js/router/sitemapMiddleware.js":
/*!**************************************************!*\
  !*** ./resources/js/router/sitemapMiddleware.js ***!
  \**************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vue_router_sitemap__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vue-router-sitemap */ "./node_modules/vue-router-sitemap/dist/index.js");
/* harmony import */ var vue_router_sitemap__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(vue_router_sitemap__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var path__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! path */ "./node_modules/path-browserify/index.js");
/* harmony import */ var path__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(path__WEBPACK_IMPORTED_MODULE_1__);
!(function webpackMissingModule() { var e = new Error("Cannot find module 'router'"); e.code = 'MODULE_NOT_FOUND'; throw e; }());




var getXML = function getXML() {
  var doc = document.implementation.createDocument('', '', null);
  var urlset = doc.createElement("urlset");
  urlset.setAttribute("xmlns", " http://www.sitemaps.org/schemas/sitemap/0.9");
  var url = '';
  var changefreq = '';
  var loc = '';
  axios.get('/api/retails').then(function (response) {
    console.log(response.data.data);
    response.data.data.map(function (item) {
      url = doc.createElement("url");
      loc = doc.createElement('loc');
      loc.innerHTML = "https://spesavicino.it/retailer/".concat(item.slug, "/").concat(item.vat);
      changefreq = doc.createElement("changefreq");
      changefreq.innerHTML = 'monthly';
      url.appendChild(loc);
      url.appendChild(changefreq);
      urlset.appendChild(url);
    })["catch"](function (error) {
      console.log(error);
    });
  }); //Let's add the dynamic data here

  doc.appendChild(urlset);
  console.log("dooooc", doc);
  return doc;
};

var app = new Vue({});
app.get('/sitemap.xml', getXML());

/***/ }),

/***/ 1:
/*!**********************!*\
  !*** util (ignored) ***!
  \**********************/
/*! no static exports found */
/***/ (function(module, exports) {

/* (ignored) */

/***/ }),

/***/ 2:
/*!**********************!*\
  !*** util (ignored) ***!
  \**********************/
/*! no static exports found */
/***/ (function(module, exports) {

/* (ignored) */

/***/ })

}]);