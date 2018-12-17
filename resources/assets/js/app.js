import Vue from 'vue'
import VueRouter from 'vue-router'
import axios from 'axios'

Vue.use(axios)

Vue.use(VueRouter)

import App from './components/App'
import Dashboard from './components/pages/Home'
import Order from './components/pages/Order'
import Process from './components/pages/Process'

Vue.component('app-header', require('./components/layouts/header.vue'));
Vue.component('app-footer', require('./components/layouts/footer.vue'));
Vue.component('order-list', require('./components/OrderList.vue'));

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
    },
    mounted() {
        this.toShowOrders();
    },
    methods: {
        searchOnClick: function(event) {
            if (this.search != '') {
                $(".loader").css("display", "block");
                axios.post('order/list', { orderId: this.search }).then(response => {
                    $("#order-list").html(response.data);
                    $(".loader").css("display", "none");
                }).catch(function(error) {
                    $(".loader").css("display", "none");
                    console.log(error);
                });
            } else {
                this.toShowOrders();
            }
        },
        toShowOrders: function() {
            axios.get('order/orderlist').then(response => {
                $("#order-list").html(response.data);
                $(".loader").css("display", "none");
            }).catch(function(error) {
                $(".loader").css("display", "none");
                console.log(error);
            });
        },
        searchKeyUp: function() {
            if (this.search != '') {
                axios.post('order/idlist', { orderId: this.search }).then(response => {
                    $("#order-ids").html(response.data);
                }).catch(function(error) {
                    console.log(error);
                });

            } else {
                toShowOrders();
            }
        }
    }
});