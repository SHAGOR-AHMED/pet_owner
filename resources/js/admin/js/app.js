require('./../../bootstrap');
window.Vue = require('vue').default;

// Router
import router from './routes';

// Vuex File
import store from './store';

//vue-filter
import {filter} from './common/filter'

// mixin global added
import common from './common/mixin';
Vue.mixin(common);

// import  BootstrapVue from 'bootstrap-vue';
// Vue.use(BootstrapVue)

// Vuetify
import Vuetify from 'vuetify'
Vue.use(Vuetify)

// VueProgressBar
import VueProgressBar from 'vue-progressbar';

Vue.use(VueProgressBar, {
    color: 'yellow',
    failedColor: 'red',
    thickness: '3px',
});

// sweetalert2
import Swal from 'sweetalert2';
const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
})
window.Swal = Swal;
window.Toast = Toast;

//vue-moment
Vue.use(require('vue-moment'));

// tbl data not available
Vue.component('data-not-available', require('./../pages/common/tbl/data_not_available.vue').default);
// tbl data loader
Vue.component('tbl-data-loader', require('./../pages/common/tbl/tbl_loader.vue').default);
// data-show-per-page
Vue.component('data-show-per-page', require('./../pages/common/tbl/data_show_per_page.vue').default);
// data-search
Vue.component('data-search', require('./../pages/common/tbl/data_search.vue').default);
// start-date
Vue.component('start-date', require('./../pages/common/tbl/start_date.vue').default);
// end-date
Vue.component('end-date', require('./../pages/common/tbl/end_date.vue').default);

// btn-component-add
Vue.component('btn-component-add', require('./../pages/common/btn/add.vue').default);
// btn-component-edit
Vue.component('btn-component-edit', require('./../pages/common/btn/edit.vue').default);
// btn-component-edit
Vue.component('btn-component-delete', require('./../pages/common/btn/delete.vue').default);
// btn-component-active-inactive
Vue.component('btn-component-active-inactive', require('./../pages/common/btn/active_inactive.vue').default);
// btn-component-website
Vue.component('btn-component-website', require('./../pages/common/btn/website.vue').default);


// admin index component
Vue.component('index-component', require('../index.vue').default);

// login component
Vue.component('login-component', require('./../../components/Login.vue').default);

// reset password component
Vue.component('reset-password-component', require('./../../components/ResetPassword.vue').default);


const app = new Vue({
  router,
  store,
  vuetify: new Vuetify(),

  data(){
    return{
      // For Preloader
      preloader:false
    }
  }

}).$mount('#app')
