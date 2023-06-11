<template>
    <v-app>
        <!-- <nav-bar></nav-bar> -->
        <v-main>
            <div>
                <router-view></router-view>
                <vue-progress-bar></vue-progress-bar>
            </div>
        </v-main>
        <scroll-top></scroll-top>
    </v-app>
</template>

<script>
import navBar from './pages/common/navbar.vue'
import pageFooter from './pages/common/footer.vue'
import scrollTop from './pages/common/scrollTop.vue'
import AOS from 'aos';
import 'aos/dist/aos.css';
AOS.init();

export default {

    props: ['authuser', 'certificate'],

    components:{
       'nav-bar'        : navBar,
       'page-footer'    : pageFooter,
       'scroll-top'     : scrollTop,
    },

    data(){
        return{
            response: false,
        }
    },

    methods:{

    },

    created(){
        this.$Progress.start();
        // Set Auth and Role data in Store
        this.$store.commit('setAuth', JSON.parse(this.authuser) )
        this.$store.commit('setCertificate', JSON.parse(this.certificate) )
        this.$Progress.finish();
    }

}
</script>

<style lang="scss">

</style>