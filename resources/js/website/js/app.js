require('./../../bootstrap');

window.Vue = require('vue').default;

// Router
import router from './routes';

// Vuex File
import store from './store';

//vue-filter
import {filter} from './common/filter'

//geolocation
import VueGeolocation from 'vue-browser-geolocation';
Vue.use(VueGeolocation);

//google map
import * as VueGoogleMaps from 'vue2-google-maps'

Vue.use(VueGoogleMaps, {
  load: {
    key: 'AIzaSyB6puUIWCOF03RCx02QIWcKH0WDpvXtLbc',
  },
  installComponents: true
})


// mixin global added
import common from './common/mixin';
Vue.mixin(common);

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

//vue-google-map
// Vue.component('gmap-map', VueGoogleMaps.Map);
// Vue.component('gmap-marker', VueGoogleMaps.Marker);
// Vue.component('gmap-info-window', VueGoogleMaps.InfoWindow);


// pagination
Vue.component('pagination', require('laravel-vue-pagination'));

// tbl data not available
Vue.component('data-not-available', require('./../pages/common/tbl/data_not_available.vue').default);
// tbl data loader
Vue.component('tbl-data-loader', require('./../pages/common/tbl/tbl_loader.vue').default);

//website index component
Vue.component('index-component', require('../index.vue').default);


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

