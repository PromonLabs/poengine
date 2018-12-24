import Vue from 'vue'
import VueRouter from 'vue-router'
import axios from 'axios'
import BootstrapVue from 'bootstrap-vue'

Vue.use(BootstrapVue);

Vue.use(axios)

Vue.use(VueRouter)

Vue.use(require('vue-moment'));

import App from './components/App'
import Dashboard from './components/pages/home'
import Order from './components/pages/order'
import Process from './components/pages/process'
import ProcessDetails from './components/pages/process-details'
import ProcessEdit from './components/pages/process-edit'
import bModal from 'bootstrap-vue/es/components/modal/modal'
import bModalDirective from 'bootstrap-vue/es/directives/modal/modal'

Vue.component('app-header', require('./components/layouts/header.vue'));
Vue.component('app-footer', require('./components/layouts/footer.vue'));
Vue.component('order-datatable', require('./components/datatable/OrderVueTable.vue'));
Vue.component('process-datatable', require('./components/datatable/ProcessVueTable.vue'));
Vue.component('order-list', require('./components/OrderList.vue'));
Vue.component('b-modal', bModal);
Vue.directive('b-modal', bModalDirective);

const router = new VueRouter({
    mode: 'history',
    routes: [{
        path: '/api/home',
        name: 'dashboard',
        component: Dashboard
    }, {
        path: '/api/order',
        name: 'order',
        component: Order
    }, {
        path: '/api/process',
        name: 'process',
        component: Process
    }, {
        path: '/api/process/details/:name',
        name: 'processdetails',
        component: ProcessDetails
    }, {
        path: '/api/process/edit/:name',
        name: 'processedit',
        component: ProcessEdit
    }, ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router
});