/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
//Import dependences.

require('bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
Vue.component('App', require('./App.vue'));
Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('order-list', require('./components/OrderList.vue'));
//Vue.component('app', require('./components/layouts/app.vue'));
Vue.component('header', require('./components/layouts/header.vue'));
Vue.component('footer', require('./components/layouts/footer.vue'));
Vue.component('sidebar', require('./components/layouts/sidebar.vue'));

// const files = require.context('./', true, /\.vue$/i)

// files.keys().map(key => {
//     return Vue.component(_.last(key.split('/')).split('.')[0], files(key))
// })

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
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