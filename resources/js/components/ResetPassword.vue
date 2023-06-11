<template>
    <div>
        <v-container>
            <v-layout row wrap>
                <v-flex xs12 sm12>
                    <v-card class="mx-auto" width="500px">
                        <v-toolbar dark color="primary">
                            <v-toolbar-title>Change your password here</v-toolbar-title>
                        </v-toolbar>
                        <v-card-text>
                            <v-container>
                                <form @submit.prevent="reset_password()">
                                    
                                    <v-layout row>
                                        <v-flex xs12>
                                            <v-text-field
                                                v-model="form.password"
                                                placeholder="Enter New Password"
                                                type="password"
                                                :error-messages="form.errors.get('password')"
                                            ></v-text-field>
                                        </v-flex>
                                    </v-layout>

                                    <v-layout row>
                                        <v-flex xs12>
                                            <v-text-field
                                                v-model="form.retype_password"
                                                placeholder="Re-type Password"
                                                type="password"
                                                :error-messages="form.errors.get('retype_password')"
                                            ></v-text-field>
                                        </v-flex>
                                    </v-layout>
                                    
                                    <v-layout row>
                                        <v-flex xs12>
                                            <v-btn
                                                type="submit"
                                                block
                                                class="my-2 btn_save"
                                                :loading="dataLodaing"
                                            ><v-icon left>mdi-key-outline</v-icon>Change Password</v-btn>
                                        </v-flex>
                                    </v-layout>
                                </form>
                            </v-container>
                        </v-card-text>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-container>
        
        <div class="w3copyright-agile">
            <p>© Powered by CPB - IT</p>
        </div>
    </div>
</template>

<script>
    import axios from "axios";
	import Form from 'vform';
    export default {
        props: ['email'],
        data(){
            return {
				dataLodaing: false,
                form: new Form({
                    email:this.email,
                	password: "",
                	retype_password: "",
                })
            }
        },

        methods: {
            reset_password(){

                if(this.form.password != this.form.retype_password){
					Toast.fire({
						icon: 'warning',
						title: 'New and Retype password should be same !'
					});
				}else{
					this.dataLodaing = true;
					this.form.post('/change_password')
					.then(response => {
						if(response.data.status == true){
                            this.dataLodaing = false;
                            Swal.fire({
                                icon: 'success',
                                title: response.data.msg,
                                text: "Login with new password",
                                showCancelButton: false,
                                allowOutsideClick:false,
                                allowEscapeKey:false,
                                allowEnterKey:false,
                                confirmButtonColor: '#d33',
                                cancelButtonColor: '#3085d6',
                                confirmButtonText: 'Ok'
                            }).then((result) => {
                                // Send request to the server
                                if (result.value) {
                                    window.location.href = "/do-logout"
                                }
                            })
						}else{
                            this.dataLodaing = false;
							Toast.fire({
								icon: 'error',
								title: response.data.msg
							});
                        }
						
					});
				}

            },

            checkRemenberToken(){
                axios.get('/check_remember_token/' + this.email).then(response => {
                    if(response.data.status == false){
                        Swal.fire({
                            icon: 'error',
                            title: response.data.msg,
                            text: "",
                            showCancelButton: false,
                            allowOutsideClick:false,
                            allowEscapeKey:false,
                            allowEnterKey:false,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            // Send request to the server
                            if (result.value) {
                                window.location.href = "/do-logout"
                            }
                        })
                    }
                });
            },
        },

        mounted() {
            this.checkRemenberToken()
        }
    }
</script>
