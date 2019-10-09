import Vue from 'vue';
import axios from 'axios';
import VueRouter from 'vue-router';
import Form from "./utilities/Form";

window.Vue = Vue;
Vue.use(VueRouter);

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Form = Form;
