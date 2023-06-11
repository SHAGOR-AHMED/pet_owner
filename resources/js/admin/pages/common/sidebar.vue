<template>
    <div>
        <v-app-bar app flat class="bg_gradient">
            <v-app-bar-nav-icon @click="drawer = !drawer" color="#ffffff"></v-app-bar-nav-icon>
            <v-spacer></v-spacer>
            <v-app-bar-title class="yellow--text"><v-chip>Administrator</v-chip></v-app-bar-title>
            <!-- {{ $moment(new Date()).format("DD-MM-YYYY") }} -->
            <v-spacer></v-spacer>
            <v-btn icon @click="toggle()">
                <v-icon v-if="fullscreen" color="#ffffff">mdi-fullscreen</v-icon>
                <v-icon v-else color="#ffffff">mdi-fullscreen-exit</v-icon>
            </v-btn>

            <v-menu open-on-hover
                bottom
                offset-y
            >
                <template v-slot:activator="{ on, attrs }">
                    <v-badge
                        color="green"
                        dot
                        offset-x="10"
                        offset-y="10"
                    >
                        <v-avatar v-bind="attrs" v-on="on" contain>
                            <img src="/all-assets/common/img/user.png" alt="image">
                        </v-avatar>
                    </v-badge>
                </template>

                <v-list>
                    <v-list-item @click="profileModal = true">
                        <v-list-item-title><v-icon left small>mdi-account</v-icon>&nbsp;Profile</v-list-item-title>
                    </v-list-item>
                    <v-list-item @click="changePasswordModal = true">
                        <v-list-item-title><v-icon left small>mdi-key</v-icon>&nbsp;Change Password</v-list-item-title>
                    </v-list-item>
                    <v-list-item link router href="/do-logout">
                        <v-list-item-title><v-icon left small>mdi-logout</v-icon>&nbsp;Logout</v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu>
        </v-app-bar>

        <!-- sidebar -->
        <v-navigation-drawer app dark v-model="drawer" class="bg_gradient">

            <v-list-item link href="/" class="py-1">
                <v-list-item-title>PET CARE</v-list-item-title>
            </v-list-item>

            <!-- <v-divider></v-divider> -->

            <v-list dense shaped class="pt-10">

                <v-list-item link router :to="{name: 'Dashboard'}" exact>
                    <v-list-item-icon>
                        <v-icon>mdi-view-dashboard</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>Dashboard</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <v-list-item link router :to="{name: 'CertificateIndex'}">
                    <v-list-item-icon>
                        <v-icon>mdi-cat</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>Certificate</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                
                <v-list-item link router :to="{name: 'MarkerIndex'}">
                    <v-list-item-icon>
                        <v-icon>mdi-map</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>Marker</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <v-list-item link router :to="{name: 'PetConciergeIndex'}">
                    <v-list-item-icon>
                        <v-icon>mdi-map</v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title>Pet Concierge</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <v-list-group
                    no-action
                    prepend-icon="mdi-shield-crown-outline"
                    active-class="white--text"
                >
                    <template v-slot:activator>
                        <v-list-item-title>Administrator</v-list-item-title>
                    </template>

                    <v-list-item link router :to="{name: 'UserIndex'}">
                        <v-list-item-icon>
                            <v-icon>mdi-account-circle</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title>Manage User</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>

                    <!-- <v-list-item link router :to="{name: 'RoleIndex'}">
                        <v-list-item-icon>
                            <v-icon>mdi-camera-control</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title>Manage Role</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item> -->

                    <v-list-item link router :to="{name: 'UserTrash'}">
                        <v-list-item-icon>
                            <v-icon>mdi-delete-empty</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title>Trash/Restore</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>

                </v-list-group>

                <v-list-item link router href="/do-logout">
                    <v-list-item-icon>
                        <v-icon>mdi-logout</v-icon>
                    </v-list-item-icon>

                    <v-list-item-content>
                        <v-list-item-title>Logout</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

            </v-list>
        </v-navigation-drawer>

        <!-- profile card modal -->
        <v-dialog v-model="profileModal" max-width="700">
            <v-card class="content py-20">
                <v-card-text>
                    <v-btn
                        @click="profileModal = false"
                        small
                        text
                        class="position-absolute close-btn ma-2"
                      >
                        <v-icon color="#ff0000">{{ customIcon.close }}</v-icon>
                    </v-btn>
                    <v-row>
                        <v-col cols="12" lg="7" md="6" sm="12">
                            <v-card-text>
                                <v-timeline
                                    align-top
                                    dense
                                    color="deep-purple lighten-1"
                                >
                                    <v-timeline-item
                                        color="deep-purple lighten-1"
                                        small
                                    >
                                        <div>
                                        <div class="font-weight-normal">
                                            <strong>{{ auth.name }}</strong>
                                        </div>
                                        </div>
                                    </v-timeline-item>

                                    <v-timeline-item
                                        color="deep-purple lighten-1"
                                        small
                                    >
                                        <div>
                                        <div class="font-weight-normal">
                                            <strong>{{ auth.email }}</strong>
                                        </div>
                                        </div>
                                    </v-timeline-item>

                                    <v-timeline-item
                                        color="deep-purple lighten-1"
                                        small
                                    >
                                        <div>
                                        <div class="font-weight-normal">
                                            <strong>{{ auth.mobile_no }}</strong>
                                        </div>
                                        </div>
                                    </v-timeline-item>

                                    <v-timeline-item
                                        color="deep-purple lighten-1"
                                        small
                                    >
                                        <div>
                                        <div class="font-weight-normal">
                                            Status@<strong>{{ (auth.status == 1) ? 'Active' : 'Inactive' }}</strong>
                                        </div>
                                        </div>
                                    </v-timeline-item>
                                </v-timeline>
                            </v-card-text>
                        </v-col>
                        <v-col cols="12" lg="5" md="6" sm="12" class="d-flex align-items-center justify-content-center">
                            <v-avatar size="180" style="border:2px dotted #e2e2e2;">
                                <img src="/all-assets/common/img/user.png" alt="no image">
                            </v-avatar>
                        </v-col>

                    </v-row>
                </v-card-text>
            </v-card>

        </v-dialog>

        <!-- change password modal -->
        <v-dialog v-model="changePasswordModal" max-width="700">
            <v-card>
                <v-card-title class="justify-center">
                    <v-row>
                        <v-col cols="10">Change Password</v-col>
                        <v-col cols="2">
                            <v-btn
                                @click="changePasswordModal = false"
                                color="btn_close lighten-1 white--text"
                                small
                                class="float-right"
                            >
                                <v-icon left dark>{{ customIcon.close }}</v-icon>Close
                            </v-btn>
                        </v-col>
                    </v-row>
                </v-card-title>

                <v-card-text>
                    <form @submit.prevent="changePassword()">
                        <v-row>
                            <v-col cols="12" sm="12" lg="12" md="12">
                                <v-text-field
                                  v-model="form.old_password"
                                  label="Enter Old Password"
                                  type="password"
                                  :error-messages="form.errors.get('old_password')"
                                  required
                                ></v-text-field>
                            </v-col>

                            <v-col cols="12" sm="12" lg="12" md="12">
                                <v-text-field
                                  v-model="form.new_password"
                                  label="Enter New Password"
                                  type="password"
                                  :error-messages="form.errors.get('new_password')"
                                  required
                                ></v-text-field>
                            </v-col>

                            <v-col cols="12" sm="12" lg="12" md="12">
                                <v-text-field
                                  v-model="form.retype_password"
                                  label="Re-type New Password"
                                  type="password"
                                  required
                                ></v-text-field>
                            </v-col>

                            <v-btn
                                type="submit"
                                block
                                class="my-2 btn_update"
                                :loading="dataLodaing"
                                ><v-icon left>mdi-key-outline</v-icon>Change Password
                            </v-btn>

                        </v-row>
                    </form>
                </v-card-text>
            </v-card>
        </v-dialog>

    </div>
</template>

<script>
// vform
import Form from "vform";

    export default {
        data() {
            return {
                fullscreen: true,
                drawer: true,
                profileModal:false,
                changePasswordModal:false,
                website_content: {},

                // Form
                form: new Form({
                    old_password: "",
                    new_password: "",
                    retype_password: "",
                }),
            };
        },

        methods: {

            changePassword(){
                if(this.form.new_password != this.form.retype_password){
                    Toast.fire({
                        icon: 'error',
                        title: 'New and Re-type password should be same !'
                    });
                }else{

                    this.dataLodaing = true
                    this.$Progress.start()
                    this.form.put('/update_password').then(response => {

                        // Input field make empty
                        this.resetForm()
                        // modal hide
                        this.changePasswordModal = false
                        this.dataLodaing = false

                        if(response.data.status == 'success'){

                            this.$Progress.finish()
                            Swal.fire({
                                icon: 'success',
                                title: 'Password Changed Successfully &#128515;',
                                text: "Do you want to logout?",
                                showCancelButton: true,
                                allowOutsideClick:false,
                                allowEscapeKey:false,
                                allowEnterKey:false,
                                confirmButtonColor: '#d33',
                                cancelButtonColor: '#3085d6',
                                confirmButtonText: 'Yes'
                            }).then((result) => {
                                // Send request to the server
                                if (result.value) {
                                    window.location.href = "/do-logout"
                                }
                            })

                        }else{

                            this.$Progress.finish()
                            Toast.fire({
                                icon: "error",
                                title: "Old Password Doesn't Match !"
                            });
                        }

                    }).catch(error=>{
                        this.dataLodaing = false;
                        Swal.fire("Failed!", data.message, "warning")
                    });

                }
            },

            toggle() {
                this.fullscreen = !this.fullscreen
                if(this.fullscreen == false){
                    this.expand();
                }else{
                    this.exitExpand();
                }
            },
            expand() {
                var elem = document.documentElement;
                if (elem.requestFullscreen) {
                    elem.requestFullscreen();
                } else if (elem.msRequestFullscreen) {
                    elem.msRequestFullscreen();
                } else if (elem.mozRequestFullScreen) {
                    elem.mozRequestFullScreen();
                } else if (elem.webkitRequestFullscreen) {
                    elem.webkitRequestFullscreen();
                }
            },
            exitExpand() {
                if (document.exitFullscreen) {
                    document.exitFullscreen();
                } else if (document.webkitExitFullscreen) {
                    document.webkitExitFullscreen();
                } else if (document.msExitFullscreen) {
                    document.msExitFullscreen();
                }
            },
        },

        created(){
           
        }

    };

</script>

<style scoped>

    a:hover {
        text-decoration: none;
    }
    .v-list-item--active {
        color: #000 !important;
        background: linear-gradient(to bottom, #f0c368 0%, #ffd60a 50%, #feb645 100%);
    }

    .theme--dark.v-list-item--active::before, .theme--dark.v-list-item--active:hover::before, .theme--dark.v-list-item:focus::before {
        opacity: .0 !important;
    }

/* common css */
    .close-btn{
        right:0px;
    }
    .content{
        background: #fff;
        background-repeat: no-repeat;
        background-size: 100% 100%;
    }

    ul li{
        list-style: none;
        text-align: left;
        border-bottom:1px solid #fff;
        color:#fff;
        margin-bottom:10px;
        padding-bottom:5px;
    }

    ul li:last-child {
        border:none;
        margin-bottom:0px;
        padding-bottom:0px;
    }

/* common css end */
</style>
