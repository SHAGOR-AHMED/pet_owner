<template>
    <div>
        <v-row class="bg-white mb-10">
            <v-col cols="12" lg="6" md="6">
                <router-link :to="{name: 'UserIndex'}" style="text-decoration: none;">
                    <v-card elevation="20" class="card-bg-img">
                        <v-row class="p-0 m-0">
                            <v-col
                                cols="3"
                                md="3"
                                lg="4"
                                class="d-flex justify-content-center align-items-center"
                            >
                                <v-btn
                                    class="text-white pa-8"
                                    icon
                                    style="background:#FBC02D !important"
                                >
                                    <v-icon x-large>mdi-account-group </v-icon>
                                </v-btn>
                            </v-col>
                            <v-col cols="9" lg="8" md="9" class="text-center" style="color:#000;" v-if="totalUser">
                                <div class="display-3 shimmer">  <i-count-up :delay="1000" :endVal="totalUser"></i-count-up> </div>
                                <div>Total User</div>
                            </v-col>
                        </v-row>
                    </v-card>
                </router-link>
            </v-col>

            <v-col cols="12" lg="6" md="6">
                <router-link :to="{name: 'CertificateIndex'}" style="text-decoration: none;">
                    <v-card elevation="20" class="card-bg-img">
                        <v-row class="p-0 m-0">
                            <v-col
                                cols="3"
                                md="3"
                                lg="4"
                                class="d-flex justify-content-center align-items-center"
                            >
                                <v-btn
                                    class="text-white pa-8"
                                    icon
                                    style="background:#FBC02D !important"
                                >
                                    <v-icon x-large>mdi-cat </v-icon>
                                </v-btn>
                            </v-col>
                            <v-col cols="9" lg="8" md="9" class="text-center" style="color:#000;" v-if="totalCertificate">
                                <div class="display-3 shimmer">  <i-count-up :delay="1000" :endVal="totalCertificate"></i-count-up> </div>
                                <div>Total Certificate</div>
                            </v-col>
                        </v-row>
                    </v-card>
                </router-link>
            </v-col>
        </v-row>
    </div>
</template>

<script>
import ICountUp from "vue-countup-v2";

export default {
    components: { ICountUp },
    data(){
        return{
            totalUser: "",
            totalCertificate: "",
        }
    },

    methods:{
        getTotalUser(){
            return axios.get("/admin/get_total_user").then(response => {
                this.totalUser = response.data;
            }).catch(function(error){
                console.log(error);
            })
        },

        getTotalCertificate(){
            return axios.get("/admin/certificate/get_total_certificate").then(response => {
                this.totalCertificate = response.data;
            }).catch(function(error){
                console.log(error);
            })
        },
    },

    async created(){
        await this.getTotalUser();
        await this.getTotalCertificate();
    }
}
</script>

<style scoped>

.card-bg-img{
    /*background: radial-gradient(circle, rgba(2,0,36,1) 0%, rgba(255,255,255,1) 0%, rgba(193,244,255,1) 100%);*/
    background: radial-gradient(circle, rgba(2,0,36,1) 0%, rgba(255,255,255,1) 0%, rgba(182,224,232,1) 100%);
    border-radius:25px;
}

.shimmer {
    color: rgba(131,58,180, 0.7);
    background: linear-gradient(90deg, rgba(131,58,180,1) 0%, rgba(253,29,29,1) 50%, rgba(252,176,69,1) 100%);
    background-size: 125px 100%;
    -webkit-background-clip: text;
    -moz-background-clip: text;
    background-clip: text;
    animation: shimmer 3s infinite;
    background-repeat: no-repeat;
    background-position: 0 0;
    background-color: #222;
}

@-moz-keyframes shimmer {
    0% {
            background-position: top left;
    }
    100% {
            background-position: top right;
    }
}

@-webkit-keyframes shimmer {
    0% {
            background-position: top left;
    }
    100% {
            background-position: top right;
    }
}

@-o-keyframes shimmer {
    0% {
            background-position: top left;
    }
    100% {
            background-position: top right;
    }
}

@keyframes shimmer {
    0% {
            background-position: top left;
    }
    100% {
            background-position: top right;
    }
}

</style>