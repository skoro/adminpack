/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

import DataTable from './components/DataTable';
import DataColumn from './components/DataColumn';
import DataPagination from './components/DataPagination';
import DataFilterText from './components/DataFilterText';
import DataFilterSelect from './components/DataFilterSelect';
import StatusBadge from './components/StatusBadge';

Vue.component('data-table', DataTable);
Vue.component('data-column', DataColumn);
Vue.component('data-pagination', DataPagination);
Vue.component('data-filter-text', DataFilterText);
Vue.component('data-filter-select', DataFilterSelect);
Vue.component('status-badge', StatusBadge);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#admin'
});

/**
 * Initialize admin jQuery event handlers.
 * 
 * It must be AFTER vue initialization because vue
 * resets (?) jQuery event callbacks.
 */
require('./admin');