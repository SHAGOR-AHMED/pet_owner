<template>
    <div>
		<v-container v-if="loginForm">
			<v-row>
				<v-col cols="12">
					<form @submit.prevent="login_attempt()" class="login_form">
						<v-toolbar-title class="d-flex align-items-center justify-content-center">
							<img src="/all-assets/common/img/PetACareCompany.png" alt="pet care" height="60px"/>
						</v-toolbar-title>
						<v-text-field
							v-model="form.email"
							placeholder="Enter Email"
							type="email"
							label="Email"
							:rules="nameRules"
							prepend-icon="mdi-account-outline"
							:error-messages="form.errors.get('email')"
							required
						></v-text-field>

						<v-text-field
							v-model="form.password"
							placeholder="Enter Password"
							:type="passwordType ? 'text' : 'password'"
							:rules="passwordRules"
							label="Password"
							:append-icon="passwordType ? 'mdi-eye' : 'mdi-eye-remove'"
							prepend-icon="mdi-lock-outline"
							:error-messages="form.errors.get('password')"
							@click:append="passwordType = !passwordType"
                            required
						></v-text-field>

						<v-btn
							type="submit"
							block
							class="py-4 mt-5 sub_button"
							:loading="dataLodaing"
						>
							<template v-slot:loader>
								<div class="dot-pulse"></div>
							</template>
							<v-icon left color="#000"> mdi-login-variant</v-icon>
							Sign In
						</v-btn>

						<div class="d-flex align-items-center justify-content-center" style="margin:20px 0px">
							<v-btn
								text
								@click="openForgetPasswordModal()"
							>Forget Password ?</v-btn>
						</div>
					</form>
				</v-col>
			</v-row>
		</v-container>

		<v-container v-if="forgetPasswordModal">
			<v-row>
				<v-col cols="12">
					<form @submit.prevent="recoverPassword()" class="forget_password_form">
						<v-text-field
							v-model="user_email"
							label="Your Email"
							placeholder="Enter Your Email"
							prepend-icon="mdi-email"
							:rules="forgetEmailRules"
						></v-text-field>

						<v-btn
							type="submit"
							block
							class="my-2 btn_update"
							:loading="dataLodaing"
							><v-icon left>mdi-key-outline</v-icon>Recover Password
						</v-btn>
						<v-btn
							@click="closeForgetPasswordModal()"
							type="submit"
							block
							class="my-2 btn_close lighten-1 white--text"
							><v-icon left>mdi-login</v-icon>Back to Login
						</v-btn>
					</form>
				</v-col>
			</v-row>
		</v-container>

    </div>
</template>

<script>
	import axios from "axios";
	import Form from 'vform';
    export default {

		props: ['targeturl'],

        name: 'Login',
        data(){
            return {
				dataLodaing: false,
				loginForm:true,
				forgetPasswordModal:false,
				user_email:"",
				passwordType: false,

				nameRules: [
					v => !!v || 'Email is required',
				],

				passwordRules: [
					v => !!v || 'Password is required',
				],

				forgetEmailRules:[
					v => !!v || 'Email is required',
				],

                form: new Form({
                	email: "",
                	password: "",
                })
            }
        },

        methods: {

			recoverPassword(){
				if(this.user_email == ''){
					Toast.fire({
						icon: "warning",
						title: "Email can't be empty !!!"
					});
				}else{
					this.dataLodaing = true;
					axios.get('/recover-password/' + this.user_email)
					.then(response =>{
						if(response.data.status == false){
							this.dataLodaing = false;
							Toast.fire({
								icon: 'warning',
								title: 'Invalid Email !!!'
							});
						}else{
							this.dataLodaing = false;
							Toast.fire({
								icon: 'success',
								title: response.data.msg
							});
						}
					});
				}
			},

			login_attempt(){
				this.dataLodaing = true;
				this.form.post('/login-check')
				.then(response =>{
					if(response.data.success == true){
						if(response.data.user.u_type == 'sa'){
							window.location.href = "/admin/index"
						}else{
							if(this.$store.state.targeturl == 'find_pet'){
								window.location.href = "/find_pet"
							}else if(this.$store.state.targeturl == 'lost_pet'){
								window.location.href = "/lost_pet"
							}else if(this.$store.state.targeturl == 'petPassport'){
								window.location.href = "/petPassport"
							}else if(this.$store.state.targeturl == 'pet_concierge'){
								window.location.href = "/pet_concierge"
							}else{
								window.location.href = "/certificate"
							}
						}
					}else if(response.data.success == 'inactive'){
                        Toast.fire({
							icon: 'error',
							title: 'Sorry! Your account is inactive'
						});
                    }else{
						Toast.fire({
							icon: 'error',
							title: 'Invalid Email or Password'
						});
					}
					this.dataLodaing = false;
				});

			},

			openForgetPasswordModal(){
				this.forgetPasswordModal = true
				this.loginForm = false
			},

			closeForgetPasswordModal(){
				this.forgetPasswordModal = false
				this.loginForm = true
			},
        },

		created(){
        this.$Progress.start();
        // Set Target Url in Store
        this.$store.commit('setTargetUrl', this.targeturl)
		console.log('URL:', this.targeturl);
        this.$Progress.finish();
    }

    }
</script>

<style>

	.theme--light.error--text.v-messages {
		color: #ff5252 !important;
	}

	.login_form {
		height: 400px;
		width: 410px;
		/*background-color: rgba(255,255,255,0.13);*/
		background-color: #f1f1f1;
		position: absolute;
		transform: translate(-50%,-50%);
		top: 50%;
		left: 50%;
		border-radius: 10px;
		backdrop-filter: blur(10px);
		border: 2px solid rgba(255,255,255,0.1);
		box-shadow: 0 0 40px rgba(8,7,16,0.6);
		padding: 25px 25px;
	}

	.sub_button{
		background: linear-gradient(to bottom, #f0c368 0%, #ffd60a 50%, #feb645 100%) !important;
		border-radius: 5px;
		font-weight: 700;
	}

	.forget_password_form {
		width: 500px;
		background-color: #f1f1f1;
		position: absolute;
		transform: translate(-50%,-50%);
		top: 50%;
		left: 50%;
		border-radius: 10px;
		border: 2px solid rgba(255,255,255,0.1);
		box-shadow: 0 0 40px rgba(8,7,16,0.6);
		padding: 25px 25px;
	}

/*======== button loader css ==========*/

	.dot-pulse {
		position: relative;
		left: -9999px;
		width: 10px;
		height: 10px;
		border-radius: 5px;
		background-color: #000;
		color: #000;
		box-shadow: 9999px 0 0 -5px;
		animation: dot-pulse 1.5s infinite linear;
		animation-delay: 0.25s;
	}

	.dot-pulse::before, .dot-pulse::after {
		content: "";
		display: inline-block;
		position: absolute;
		top: 0;
		width: 10px;
		height: 10px;
		border-radius: 5px;
		background-color: #000;
		color: #000;
	}

	.dot-pulse::before {
		box-shadow: 9984px 0 0 -5px;
		animation: dot-pulse-before 1.5s infinite linear;
		animation-delay: 0s;
	}

	.dot-pulse::after {
		box-shadow: 10014px 0 0 -5px;
		animation: dot-pulse-after 1.5s infinite linear;
		animation-delay: 0.5s;
	}

	@keyframes dot-pulse-before {
		0% {
		box-shadow: 9984px 0 0 -5px;
		}
		30% {
		box-shadow: 9984px 0 0 2px;
		}
		60%, 100% {
		box-shadow: 9984px 0 0 -5px;
		}
	}

	@keyframes dot-pulse {
		0% {
		box-shadow: 9999px 0 0 -5px;
		}
		30% {
		box-shadow: 9999px 0 0 2px;
		}
		60%, 100% {
		box-shadow: 9999px 0 0 -5px;
		}
	}

	@keyframes dot-pulse-after {
		0% {
		box-shadow: 10014px 0 0 -5px;
		}
		30% {
		box-shadow: 10014px 0 0 2px;
		}
		60%, 100% {
		box-shadow: 10014px 0 0 -5px;
		}
	}

</style>
