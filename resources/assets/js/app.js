
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

Vue.component('countdown', require('./components/Countdown.vue'));

$('div.alert').not('.alert-important').delay(3000).fadeOut(350);
