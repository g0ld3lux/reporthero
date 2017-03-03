/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import router from './router.js'
import Layout from './helpers/layout'
import store from './vuex/store/';
import 'babel-polyfill';


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */



const app = new Vue({
    router,
    store,
    methods : {
        onOverlayClick(){
            Layout.toggleSidebar()
        },
        getMe(){
        // Save this current user in vuex 
        // Save the users object in vuex
        // Create a New Module of vuex for user
        axios.get('/@me').then(({data}) => console.log(data))
        axios.get('/users').then(({data}) => console.log(data))
        },
    },
    // We Shoul Save this in Vuex for the Auth Module
    mounted() {
        this.getMe();
    }
}).$mount('#app')

