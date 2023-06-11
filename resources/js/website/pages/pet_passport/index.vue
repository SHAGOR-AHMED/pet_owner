<template>
    <div>
      <v-card class="space px-2 mb-10">
        <v-card-title class="justify-center">
          <v-row>
            <v-col cols="12" md="12" lg="12">Pet Passport <a href="/do-logout" class="btn btn-danger btn-sm text-white">
              Logout
            </a></v-col>
          </v-row>
        </v-card-title>
  
        <v-card-text>
          <div>
            <form @submit.prevent="updateData()">
              <v-row>
                <!-- Image -->
                <v-col cols="12" lg="4" md="4">
                  <v-file-input prepend-icon="mdi-camera"
                   show-size truncate-length="15" small-chips @change="uploadImageByName($event, 'image', ['jpg', 'png', 'jpeg'])"
                        label="Choose Vaccination Records" size="sm" accept=".jpg, .png, .jpeg" :error-messages="form.errors.get('image')">
                    </v-file-input>
                </v-col>
                <!-- Image2 -->
                <v-col cols="12" lg="4" md="4">
                    <v-file-input prepend-icon="mdi-camera"
                    show-size truncate-length="15" small-chips @change="uploadImageByName($event, 'image2', ['jpg', 'png', 'jpeg'])"
                        label="Choose Medical Documents" size="sm" accept=".jpg, .png, .jpeg" :error-messages="form.errors.get('image')">
                    </v-file-input>
                </v-col>
                <!-- Image3 -->
                <v-col cols="12" lg="4" md="4">
                    <v-file-input prepend-icon="mdi-camera"
                    show-size truncate-length="15" small-chips @change="uploadImageByName($event, 'image3', ['jpg', 'png', 'jpeg'])"
                        label="Choose City Registration" size="sm" accept=".jpg, .png, .jpeg" :error-messages="form.errors.get('image')">
                    </v-file-input>
                </v-col>
              </v-row>

              <v-row>
                <v-col cols="12" lg="4" md="4">
                  <a href="#" @click="viewDetails(form.image)">
                    <img :src="showImageByName('image')"
                      class="rounded mx-auto d-block image-thum-size" />
                    </a>
                </v-col>
                <v-col cols="12" lg="4" md="4">
                  <a href="#" @click="viewDetails(form.image2)">
                    <img :src="showImageByName('image2')"
                      class="rounded mx-auto d-block image-thum-size" />
                  </a>
                </v-col>
                <v-col cols="12" lg="4" md="4">
                  <a href="#" @click="viewDetails(form.image3)">
                    <img :src="showImageByName('image3')"
                      class="rounded mx-auto d-block image-thum-size" />
                  </a>
                </v-col>
              </v-row>

              <v-row>
                <!-- Image4 -->
                <v-col cols="12" lg="4" md="4">
                    <v-file-input prepend-icon="mdi-camera"
                    show-size truncate-length="15" small-chips @change="uploadImageByName($event, 'image4', ['jpg', 'png', 'jpeg'])"
                        label="Choose Service Animal Certificate" size="sm" accept=".jpg, .png, .jpeg" :error-messages="form.errors.get('image')">
                    </v-file-input>
                </v-col>
                <!-- Image5 -->
                <v-col cols="12" lg="4" md="4">
                    <v-file-input prepend-icon="mdi-camera"
                    show-size truncate-length="15" small-chips @change="uploadImageByName($event, 'image5', ['jpg', 'png', 'jpeg'])"
                        label="Choose Microchip Identification Information" size="sm" accept=".jpg, .png, .jpeg" :error-messages="form.errors.get('image')">
                    </v-file-input>
                </v-col>
                <!-- Image6 -->
                <v-col cols="12" lg="4" md="4">
                    <v-file-input prepend-icon="mdi-camera"
                    show-size truncate-length="15" small-chips @change="uploadImageByName($event, 'image6', ['jpg', 'png', 'jpeg'])"
                        label="Choose Proof of Insurance" size="sm" accept=".jpg, .png, .jpeg" :error-messages="form.errors.get('image')">
                    </v-file-input>
                </v-col>
              </v-row>

              <v-row>
                <v-col cols="12" lg="4" md="4">
                  <a href="#" @click="viewDetails(form.image4)">
                    <img :src="showImageByName('image4')"
                      class="rounded mx-auto d-block image-thum-size" />
                  </a>
                </v-col>
                <v-col cols="12" lg="4" md="4">
                  <a href="#" @click="viewDetails(form.image5)">
                    <img :src="showImageByName('image5')"
                      class="rounded mx-auto d-block image-thum-size" />
                  </a>
                </v-col>
                <v-col cols="12" lg="4" md="4">
                  <a href="#" @click="viewDetails(form.image6)">
                    <img :src="showImageByName('image6')"
                      class="rounded mx-auto d-block image-thum-size" />
                  </a>
                </v-col>
              </v-row>

              <v-row>
                <!-- Image7 -->
                <v-col cols="12" lg="4" md="4">
                    <v-file-input prepend-icon="mdi-camera"
                    show-size truncate-length="15" small-chips @change="uploadImageByName($event, 'image7', ['jpg', 'png', 'jpeg'])"
                        label="Choose BioTech Pet DNA Identification Certificate" size="sm" accept=".jpg, .png, .jpeg" :error-messages="form.errors.get('image')">
                    </v-file-input>
                </v-col>
                <!-- Image8 -->
                <v-col cols="12" lg="4" md="4">
                    <v-file-input prepend-icon="mdi-camera"
                    show-size truncate-length="15" small-chips @change="uploadImageByName($event, 'image8', ['jpg', 'png', 'jpeg'])"
                        label="Choose Breed DNA Testing Information" size="sm" accept=".jpg, .png, .jpeg" :error-messages="form.errors.get('image')">
                    </v-file-input>
                </v-col>
                <!-- Image9 -->
                <v-col cols="12" lg="4" md="4">
                    <v-file-input prepend-icon="mdi-camera"
                    show-size truncate-length="15" small-chips @change="uploadImageByName($event, 'image9', ['jpg', 'png', 'jpeg'])"
                        label="Choose Health & Wellness Information" size="sm" accept=".jpg, .png, .jpeg" :error-messages="form.errors.get('image')">
                    </v-file-input>
                </v-col>
              </v-row>

              <v-row>
                <v-col cols="12" lg="4" md="4">
                  <a href="#" @click="viewDetails(form.image7)">
                    <img :src="showImageByName('image7')"
                      class="rounded mx-auto d-block image-thum-size" />
                  </a>
                </v-col>
                <v-col cols="12" lg="4" md="4">
                  <a href="#" @click="viewDetails(form.image8)">
                    <img :src="showImageByName('image8')"
                      class="rounded mx-auto d-block image-thum-size" />
                  </a>
                </v-col>
                <v-col cols="12" lg="4" md="4">
                  <a href="#" @click="viewDetails(form.image9)">
                    <img :src="showImageByName('image9')"
                      class="rounded mx-auto d-block image-thum-size" />
                  </a>
                </v-col>
              </v-row>

              <v-row>
                <!-- Image10 -->
                <v-col cols="12" lg="4" md="4">
                    <v-file-input prepend-icon="mdi-camera"
                    show-size truncate-length="15" small-chips @change="uploadImageByName($event, 'image10', ['jpg', 'png', 'jpeg'])"
                        label="Choose Other Document" size="sm" accept=".jpg, .png, .jpeg" :error-messages="form.errors.get('image')">
                    </v-file-input>
                </v-col>
              </v-row>

              <v-row>
                <v-col cols="12" lg="4" md="4">
                  <a href="#" @click="viewDetails(form.image10)">
                    <img :src="showImageByName('image10')"
                      class="rounded mx-auto d-block image-thum-size" />
                  </a>
                </v-col>
              </v-row>

              <v-row>
                <v-btn
                  type="submit"
                  block
                  class="my-2 btn_update"
                  :loading="dataLodaing"
                ><v-icon left>{{ customIcon.update }}</v-icon>Update
                </v-btn>
              </v-row>
            </form>
          </div>
        </v-card-text>
      </v-card>

      <!-- view data modal start -->
      <v-dialog v-model="viewDataModal" width="900">
        <v-card>
            <v-card-title class="justify-center">
                <v-row>
                <v-col cols="12">
                    <v-btn
                      @click="viewDataModal = false"
                      color="btn_close lighten-1 white--text"
                      small
                      class="float-right"
                    >
                    <v-icon dark>{{ customIcon.close }}</v-icon>
                    </v-btn>
                </v-col>
                </v-row>
            </v-card-title>
            <v-card-text>
                <div>
                  <img :src="imagePath + imgName" class="rounded mx-auto" style="max-width: 800px;" />
                </div>
            </v-card-text>
        </v-card>
      </v-dialog>

    </div>
  </template>
  
  <script>
  import axios from "axios";
  // vform
  import Form from "vform";
  export default {
      data() {
        return {
          //current url
          currentUrl: "/pet_passport",
          imagePath: "/images/backend/petpassport/",
          imagePathSm: "/images/backend/petpassport/small/",

          user_id: this.$store.state.auth.id,
          viewDataModal:false,
          imgName: "",

          // Form
          form: new Form({
              id: "",
              image: "",
              image2: "",
              image3: "",
              image4: "",
              image5: "",
              image6: "",
              image7: "",
              image8: "",
              image9: "",
              image10: "",
          }),
          
        };
      },
  
      methods: {
        // Get table data
        getResults(page = 1) {
          this.dataLoading = true;
          return axios.get(this.currentUrl).then(response => {
              this.allData = response.data;
              this.totalValue = response.data.total;
              this.dataShowFrom = response.data.from;
              this.dataShowTo = response.data.to;
              this.currentPageNumber  = response.data.current_page
              this.v_total = response.data.last_page;
              // Loading Animation
              this.dataLoading = false;
          });
        },

        getPetPasspord(){
          return axios.get('/pet_passport/get_passport_by_userId/' + this.user_id).then(response =>{
                this.form.reset();
                this.form.fill(response.data);
            })
        },

        viewDetails(val){
          this.viewDataModal = true;
          this.imgName = val;
        },

      },
  
      computed: {
        
      },
  
      async mounted() {
        this.$Progress.start();
        await this.getResults();
        await this.getPetPasspord();
        this.$Progress.finish();
      },
  
      created(){
  
      },
  
  };
  </script>
  <style scoped>
    .image-thum-size {
      height: 120px;
      width: 120px;
    }
</style>