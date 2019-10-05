// var VueResource = require('vue-resource');
// Vue.use(VueResource);
require('./bootstrap');
import 'es6-promise/auto';
import axios from 'axios';

import Vue from 'vue';

import VueAuth from '@websanova/vue-auth';
import VueAxios from 'vue-axios';
import VueRouter from 'vue-router';

import BootstrapVue from 'bootstrap-vue';
import 'bootstrap-vue/dist/bootstrap-vue.css';
import CxltToastr from 'cxlt-vue2-toastr';
import DataTable from 'laravel-vue-datatable';

import Index from './Index';
import auth from './auth';
import router from './router';



//Set Vue globally
window.Vue = Vue;

//Set the vue router
Vue.router = router
Vue.use(VueRouter)

//Set Vue authentication
Vue.use(VueAxios, axios)
axios.defaults.baseURL = 'http://kredoIMS.test/api'
Vue.use(VueAuth, auth)

//VueBootstrap and Datatable
Vue.use(BootstrapVue)
Vue.use(DataTable);

Vue.use(CxltToastr, {
    position: 'top right',
});

//Load Index
// Vue.component('index', Index);

// const app = new Vue({
//     el: "#app",
//     router
// });

const app = new Vue(Vue.util.extend({router}, Index)).$mount('#app');