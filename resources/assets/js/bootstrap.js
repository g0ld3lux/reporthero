import lodash from 'lodash'
import Vue from 'vue'
import moment from 'moment'
import VueRouter from 'vue-router'
import VeeValidate from 'vee-validate'
import Axios from 'axios'
import Ls from './services/ls'
import Chartist from 'chartist'
import Plugins from './helpers/plugin'
import Vuex from 'vuex';
import VuePagination from 'vue-pagination-2';
import Vue2Filters from 'vue2-filters'



window._ = lodash
window.Vue = Vue
window.moment = moment
window.router = VueRouter
window.Chartist = Chartist
window.vuex = Vuex;
window.axios = Axios
window.Plugin = Plugins


Vue.use(VueRouter)
Vue.use(VeeValidate);
Vue.use(Vuex);
Vue.use(VuePagination,[Vuex])
Vue.use(Vue2Filters)


/**
 * We'll register a HTTP interceptor to attach the "CSRF" header to each of
 * the outgoing requests issued by this application. The CSRF middleware
 * included with Laravel will automatically verify the header's value.
 */
window.axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest'
};
/**
 * Interceptors
 */

axios.interceptors.request.use(function (config) {
    // Do something before request is sent
    const AUTH_TOKEN = Ls.get('auth.token');

    if(AUTH_TOKEN){
        config.headers.common['Authorization'] = `Bearer ${AUTH_TOKEN}`
    }

    return config;
}, function (error) {
    // Do something with request error
    return Promise.reject(error);
});




