import axios from "axios";
import { mapGetters } from 'vuex'

import paginateMethods from './paginate_methods'
import imageMethods from './image_methods'
import createUpdate from './crud'
import icon from './../../../admin/pages/common/js/icon'
import btn_title from './../../../admin/pages/common/js/btn_title'

import globalRolePermissions from './../../../role_permissions'
import { forEach, isEmpty } from "lodash";

export default {
    data() {
      return {

        // DataTbl Common Featurs
        paginate: 10,
        search: '',
        search_field: '',
        sort_direction: 'desc',
        sort_field: 'id',
        currentPageNumber: null,
        // Our data object that holds the Laravel paginator data
        allData: {},
        website_content: [],
        totalValue: '',
        dataShowFrom: '',
        dataShowTo: '',
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

        imageMaxSize: '2111775',
        fileMaxSize: '5111775',
        overlayshow: false,

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

        // get website info
        getWebsiteInfo(){
            this.dataLoading = true;
            return axios.get('/get_website_content').then(response => {
                this.website_content = response.data
                this.dataLoading = false;
            }).catch(error =>{
                console.log(error)
            });
        },

        //language translator function
        translator(val){

            let rst = 'N/A'
            const result = this.lang.find((item)=>{
                return item.t_id_slug == val;
            })
            if(result !== undefined){
                if(this.crntlang == 'bn'){
                    if(isEmpty(result.bl)){
                        rst = 'N/A';
                    }else{
                        rst = result.bl;
                    }
                }else{
                    rst =  result.default;
                }
            }
            return rst;

        },


        handleResize() {
            this.window.width = window.innerWidth;
            this.window.height = window.innerHeight;
        },

        // End Methods
    },

    watch: {

        //Excuted When make change value
        paginate: function (value) {
            this.$Progress.start();
            this.getResults();
            this.$Progress.finish();
        },

        //Excuted When make change value
        search: function (value) {
            this.$Progress.start();
            this.getResults();
            this.$Progress.finish();
        },

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
        //this.getWebsiteInfo();
    },

    destroyed() {
        // window.removeEventListener('resize', this.handleResize);
    },

    computed : {

        // map this.count to store.state.count getLoading
        ...mapGetters({
            "auth"          : "getAuth",
            "certification" : "getCertification"
        }),

    },


  }

