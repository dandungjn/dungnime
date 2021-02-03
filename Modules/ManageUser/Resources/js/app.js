Vue.component('login-form', () => import('./components/Auth/LoginForm.vue'));
Vue.component('forgot-password-form', () => import('./components/Auth/ForgotPasswordForm.vue'));
Vue.component('reset-password-form', () => import('./components/Auth/ResetPasswordForm.vue'));

Vue.component('user-form', () => import('./components/User/Form.vue'));
Vue.component('grup-user-form', () => import('./components/GrupUser/Form.vue'));
Vue.component('member-form', () => import('./components/Member/Form.vue'));