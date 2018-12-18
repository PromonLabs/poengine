import Vue from 'vue'
import VueRouter from 'vue-router'
import axios from 'axios'
import BootstrapVue from 'bootstrap-vue'

Vue.use(BootstrapVue);

Vue.use(axios)

Vue.use(VueRouter)

import App from './components/App'
import Dashboard from './components/pages/Home'
import Order from './components/pages/Order'
import Process from './components/pages/Process'
//import 'bootstrap/dist/css/bootstrap.css'
//import 'bootstrap-vue/dist/bootstrap-vue.css'
import bModal from 'bootstrap-vue/es/components/modal/modal'
import bModalDirective from 'bootstrap-vue/es/directives/modal/modal'

Vue.component('app-header', require('./components/layouts/header.vue'));
Vue.component('app-footer', require('./components/layouts/footer.vue'));
Vue.component('order-datatable', require('./components/datatable/OrderVueTable.vue'));
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
    }, ],
});

const app = new Vue({
    el: '#app',
    components: { App },
    router,
    data: {
        search: null,
        processName: null,
    },
    mounted() {
        this.toShowProcessList();
    },
    methods: {
        toShowProcessList: function() {
            axios.get('process/list').then(response => {
                $("#process-list").html(response.data);
                $(".loader").css("display", "none");
            }).catch(function(error) {
                $(".loader").css("display", "none");
                console.log(error);
            });
        },
        searchProcess: function() {
            if (this.processName != '') {
                axios.post('process/name/list', { processName: this.processName }).then(response => {
                    $("#process-names").html(response.data);
                }).catch(function(error) {
                    console.log(error);
                });
            } else {
                this.toShowProcessList();
            }
        },
        searchProcessOnClick: function() {
            if (this.processName != '') {
                $(".loader").css("display", "block");
                axios.post('process/list', { processName: this.processName }).then(response => {
                    $("#process-list").html(response.data);
                    $(".loader").css("display", "none");
                }).catch(function(error) {
                    $(".loader").css("display", "none");
                    console.log(error);
                });
            } else {
                this.toShowProcessList();
            }
        }
    }
});
