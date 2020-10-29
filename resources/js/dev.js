require('./bootstrap');
window.Vue = require('vue');
window.Vuex = require('vuex');
import Multiselect from 'vue-multiselect';
window.moment = require('moment');
import Datepicker from 'vuejs-datepicker';
window.lang = require('vuejs-datepicker/src/locale');
window.Vuetable = require('vuetable-2');
import VueEvents from 'vue-events';
import { Datetime } from 'vue-datetime';
import 'vue-datetime/dist/vue-datetime.css'
Vue.component('datetime', Datetime);


// use the plugin
Vue.use(Vuex);
Vue.use(Vuetable);
Vue.use(VueEvents);

// register globally
Vue.component('multiselect', Multiselect)
Vue.component('datepicker', Datepicker)
Vue.component('datetime', Datetime);

Vue.component('vuetable-pagination', Vuetable.VuetablePagination);
Vue.component('pagination', require('./components/LaravelVuePagination.vue').default);
Vue.component('loader', require('./components/Loader.vue').default);
Vue.component('modal', require('./shared/Modal.vue').default);
Vue.component('filter-bar', require('./components/FilterBar.vue').default);
Vue.component('worker-panel', require('./shared/WorkerPanel.vue').default);
Vue.component('cita-trabajador', require('./shared/WorkerPanel.vue').default);
