(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[8],{

/***/ "./Modules/ManageUser/Resources/js/components/Auth/LoginForm.vue":
/*!***********************************************************************!*\
  !*** ./Modules/ManageUser/Resources/js/components/Auth/LoginForm.vue ***!
  \***********************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _LoginForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./LoginForm.vue?vue&type=script&lang=js& */ "./Modules/ManageUser/Resources/js/components/Auth/LoginForm.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../../../../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");
var render, staticRenderFns




/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_1__["default"])(
  _LoginForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"],
  render,
  staticRenderFns,
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "Modules/ManageUser/Resources/js/components/Auth/LoginForm.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./Modules/ManageUser/Resources/js/components/Auth/LoginForm.vue?vue&type=script&lang=js&":
/*!************************************************************************************************!*\
  !*** ./Modules/ManageUser/Resources/js/components/Auth/LoginForm.vue?vue&type=script&lang=js& ***!
  \************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_LoginForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../../../../node_modules/babel-loader/lib??ref--4-0!../../../../../../node_modules/vue-loader/lib??vue-loader-options!./LoginForm.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./Modules/ManageUser/Resources/js/components/Auth/LoginForm.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_LoginForm_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./Modules/ManageUser/Resources/js/components/Auth/LoginForm.vue?vue&type=script&lang=js&":
/*!********************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./Modules/ManageUser/Resources/js/components/Auth/LoginForm.vue?vue&type=script&lang=js& ***!
  \********************************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var vee_validate__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! vee-validate */ "./node_modules/vee-validate/dist/vee-validate.esm.js");
/* harmony import */ var vee_validate_dist_rules__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! vee-validate/dist/rules */ "./node_modules/vee-validate/dist/rules.js");
/* harmony import */ var vee_validate_dist_locale_id_json__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! vee-validate/dist/locale/id.json */ "./node_modules/vee-validate/dist/locale/id.json");
var vee_validate_dist_locale_id_json__WEBPACK_IMPORTED_MODULE_2___namespace = /*#__PURE__*/__webpack_require__.t(/*! vee-validate/dist/locale/id.json */ "./node_modules/vee-validate/dist/locale/id.json", 1);



Object(vee_validate__WEBPACK_IMPORTED_MODULE_0__["extend"])('required', vee_validate_dist_rules__WEBPACK_IMPORTED_MODULE_1__["required"]);
Object(vee_validate__WEBPACK_IMPORTED_MODULE_0__["extend"])('email', vee_validate_dist_rules__WEBPACK_IMPORTED_MODULE_1__["email"]);
Object(vee_validate__WEBPACK_IMPORTED_MODULE_0__["localize"])('id', vee_validate_dist_locale_id_json__WEBPACK_IMPORTED_MODULE_2__);
/* harmony default export */ __webpack_exports__["default"] = ({
  components: {
    ValidationObserver: vee_validate__WEBPACK_IMPORTED_MODULE_0__["ValidationObserver"],
    ValidationProvider: vee_validate__WEBPACK_IMPORTED_MODULE_0__["ValidationProvider"]
  },
  props: {
    actionForm: {
      type: String,
      required: true
    }
  },
  data: function data() {
    return {
      form_data: {
        email: '',
        password: '',
        selected: false
      },
      show_password: false,
      field_state: false,
      form_alert_state: false,
      form_alert_color: '',
      form_alert_text: ''
    };
  },
  methods: {
    clearForm: function clearForm() {
      this.form_data = {
        email: '',
        password: '',
        selected: false
      };
      this.$refs.observer.reset();
    },
    submitForm: function submitForm() {
      var _this = this;

      this.$refs.observer.validate().then(function (success) {
        if (!success) {
          return;
        }

        _this.field_state = true;

        _this.postFormData();
      });
    },
    postFormData: function postFormData() {
      var _this2 = this;

      var form_data = new FormData(this.$refs['post-form']);
      axios.post(this.actionForm, form_data).then(function (response) {
        if (response.data.success) {
          _this2.form_alert_state = true;
          _this2.form_alert_color = 'success';
          _this2.form_alert_text = response.data.message;
          setTimeout(function () {
            _this2["goto"](response.data.data);
          }, 6000);
        } else {
          _this2.field_state = false;
          _this2.form_alert_state = true;
          _this2.form_alert_color = 'error';
          _this2.form_alert_text = response.data.message;
        }
      })["catch"](function (error) {
        _this2.field_state = false;
        _this2.form_alert_state = true;
        _this2.form_alert_color = 'error';
        _this2.form_alert_text = 'Oops, something went wrong. Please try again later.';
      });
    }
  }
});

/***/ })

}]);