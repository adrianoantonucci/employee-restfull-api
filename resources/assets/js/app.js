/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
 
require('./bootstrap');
 
window.Vue = require('vue');
import VueRouter from 'vue-router';
 
window.Vue.use(VueRouter);
 
import DevelopersIndex from './components/developers/DevelopersIndex.vue';
import DevelopersCreate from './components/developers/DevelopersCreate.vue';
import DevelopersEdit from './components/developers/DevelopersEdit.vue';
 
const routes = [
    {
        path: '/',
        components: {
            developersIndex: DevelopersIndex
        }
    },
    {path: '/developers/create', component: DevelopersCreate, name: 'createDeveloper'},
    {path: '/developers/edit/:id', component: DevelopersEdit, name: 'editDeveloper'},
]
 
const router = new VueRouter({ routes })
 
const app = new Vue({ router }).$mount('#app')