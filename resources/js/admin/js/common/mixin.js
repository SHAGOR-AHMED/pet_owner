import axios from "axios";
import { mapGetters } from 'vuex'

import paginateMethods from './paginate_methods'
import imageMethods from './image_methods'
import createUpdate from './crud'
import bulkActions from './bulk_actions'
import icon from './../../pages/common/js/icon'
import btn_title from './../../pages/common/js/btn_title'

import globalRolePermissions from './../../../role_permissions'
import {debounce} from './../../../helpers'

export default {
    data() {
      return {
      
        paginate: 10,
        search: "",
        search_field: "",
        sort_direction: "desc",
        sort_field: "id",
        currentPageNumber: null,
        // Our data object that holds the Laravel paginator data
        allData: {},
        totalValue: "",
        dataShowFrom: "",
        dataShowTo: "",
        v_total: null,

        // For Modal Dilog
        dataModalDialog :false,
        // Loading Animation
        dataModalLoading: false,

        editmode: false,
        dataModal:false,
        dataLodaing:false,
        dataModelTitle: "",
        // Loading Animation
        dataLoading: false,

        imageMaxSize: "2111775",
        fileMaxSize: "5111775",

        // Tbl number of data show
        tblItemNumberShow:[5,10,15,25,50,100],
        // v-form
        valid: false,

        //all btn icons and title
        ...icon,
        ...btn_title,

      }
    },

    methods: {

        // Permission Role check
        ...globalRolePermissions,
      
        // Paginate Methods
        ...paginateMethods,

        // Image Upload Methods
        ...imageMethods,

        // create Update Methods
        ...createUpdate,

        // Bulk actions Methods
        ...bulkActions,

    },

    watch: {

        //Excuted When make change value 
        paginate: function (value) {
            this.$Progress.start();
            this.getResults();
            this.$Progress.finish();
        },

        //Excuted When make change value 
        search: debounce(function () {
            this.$Progress.start();
            this.getResults();
            this.$Progress.finish();
        }, 500),

        //Excuted When make change value 
        search_field: function (value) {
            this.$Progress.start();
            this.getResults();
            this.$Progress.finish();
        }
       
    },

    created() {
        // window.addEventListener('resize', this.handleResize);
        // this.handleResize();
    },


    mounted() {
 
    },


    destroyed() {
        // window.removeEventListener('resize', this.handleResize);
    },

    computed : {

        // map this.count to store.state.count getLoading 
        ...mapGetters({
            "auth"      : "getAuth",
            "roles"     : "getRoles",
            "mytargeturl" : "getTargetUrl",
        }),

    },


  }