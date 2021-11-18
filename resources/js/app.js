/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';
import App from './App.vue';
import VueMeta from 'vue-meta';

import VueScrollTo from 'vue-scrollto'
Vue.use(VueScrollTo)

import VueAxios from 'vue-axios'
Vue.use(VueAxios, axios)

import VueFlashMessage from 'vue-flash-message';
Vue.use(VueFlashMessage);

import VueRouter from 'vue-router'
Vue.use(VueRouter)
Vue.use(VueMeta, {
    keyName: 'metaInfo',
})
import routes from './router'
const router = new VueRouter({
    mode: "history",
    base: __dirname,
    routes,
    linkActiveClass: 'active',
    scrollBehavior(to, from, savedPosition) {
        if (to.hash) {
            // return window.scrollTo({
            //     top: document.querySelector(to.hash).offsetTop,
            //     behavior: 'smooth'
            // })
            return {
                selector: to.hash,
                behavior: 'smooth'
            }
        } else {
            return { x: 0, y: 0 }
        }
    }
});

import store from './store'

import Geocoder from "@pderas/vue2-geocoder";


Vue.use(Geocoder, {
    defaultCountryCode: null, // e.g. 'CA'
    defaultLanguage: null, // e.g. 'en'
    defaultMode: 'address', // or 'lat-lng'
    googleMapsApiKey: 'AIzaSyAE2uvelXOquzqj7m7B6cKn44QBcF86lo4'
});

Vue.config.productionTip = false

Vue.component('passport-clients', require('./components/passport/Clients.vue').default);
Vue.component('passport-authorized-clients', require('./components/passport/AuthorizedClients.vue').default);
Vue.component('passport-personal-access-tokens', require('./components/passport/PersonalAccessTokens.vue').default);
Vue.component('register-section', require('./components/register/RegisterComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// const app = new Vue({
//     el: '#app',
// });
export const eventBus = new Vue(); // new event for send data extra parent/child

// var deferredPrompt;
// window.addEventListener('beforeinstallprompt', function (event) {
//     event.preventDefault();
//     deferredPrompt = event;
//     return false;
// });

// function addToHomeScreen() {
//     if (deferredPrompt) {
//         deferredPrompt.prompt();
//         deferredPrompt.userChoice.then(function (choiceResult) {
//             console.log(choiceResult.outcome);
//             if (choiceResult.outcome === 'dismissed') {
//                 console.log('User cancelled installation');
//             } else {
//                 console.log('User added to home screen');
//             }
//         });
//         deferredPrompt = null;
//     }
// }

Vue.filter('capitalize', function(value) {
    if (!value) return ''
    value = value.toString()
    return value.charAt(0).toUpperCase() + value.slice(1)
})

Vue.filter('truncateText', function(value) {
    if (!value) return ''
    value = value.toString()
    return value.substring(0, 70);
})

// import AppLayout from './layouts/AppLayout';
import CustomLayout from './layouts/CustomLayout.vue';
import HomeLayout from './layouts/HomeLayout.vue';
import ShopLayout from './layouts/ShopLayout.vue';
import BackendLayout from './layouts/BackendLayout.vue'
import DefaultLayout from './layouts/DefaultLayout.vue';
import BasicLayout from './layouts/BasicLayout.vue';


Vue.component('default-layout', DefaultLayout)
Vue.component('custom-layout', CustomLayout)
Vue.component('home-layout', HomeLayout)
Vue.component('shop-layout', ShopLayout)
Vue.component('backend-layout', BackendLayout)
Vue.component('basic-layout', BasicLayout)

new Vue({
    router,
    store,
    render: h => h(App),
}).$mount('#app')
