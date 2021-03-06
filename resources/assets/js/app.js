
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('videoUpload', require('./components/VideoUpload.vue'));
Vue.component('videoPlayer', require('./components/videoPlayer.vue'));
Vue.component('videoVoting', require('./components/videoVoting.vue'));
Vue.component('videoComments', require('./components/videoComments.vue'));
Vue.component('subscribeButton', require('./components/subscribeButton.vue'));

const app = new Vue({
    el: '#app',
    data: window.codetube
});
