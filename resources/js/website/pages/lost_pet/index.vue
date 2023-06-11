<template>
    <div>
      <v-card class="space px-2 mb-10">
        <v-card-title class="justify-center">
          <v-row>
            <v-col cols="8">Lost Pet Flyer List</v-col>
            <v-col cols="2">
              <v-btn
                @click="addDataModel('Add New Lost Pet')"
                class="btn_add float-right"
                small
              >
                <v-icon left>mdi-plus-circle-outline</v-icon>Create New Flyer
              </v-btn>
            </v-col>
            <v-col cols="2">
              <a href="/do-logout" class="btn btn-sm btn-danger text-white">
                Logout
              </a>
            </v-col>
          </v-row>
        </v-card-title>
  
        <v-card-text>
          <div>
            <div class="table-responsive" v-if="allData.data && !dataLoading">
              <table class="table table-bordered text-center">
                <thead class="table-dark">
                  <tr>
                    <th>ID</th>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Color</th>
                      <th>Contact</th>
                      <th>Note</th>
                      <th>Reward</th>
                      <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="singleData in allData.data" :key="singleData.id">
                    <td>{{ singleData.id }}</td>
                    <td>
                      <v-avatar size="70">
                        <img v-if="singleData.image" :src="imagePathSm + singleData.image" alt="image">
                        <img v-else src="/all-assets/common/img/no-image.png" alt="no image">
                      </v-avatar>
                    </td>
                    <td>{{ singleData.name }}</td>
                    <td>{{ singleData.color }}</td>
                    <td>{{ singleData.contact_info }}</td>
                    <td>{{ singleData.note }}</td>
                    <td>{{ singleData.reward }}$</td>
                    <td class="text-center">
                      <v-btn text link route :to="`/lost_pet_flyer/${singleData.id}`" small >
                        View Flyer
                      </v-btn>
                      <!-- <v-btn
                        small
                        text
                        icon
                        class="btn_details ma-1"
                        title="View"
                        @click="viewDetails(singleData)"
                      >
                        <v-icon small>mdi-eye</v-icon>
                      </v-btn> -->
                      <v-btn
                        small
                        text
                        icon
                        class="btn_edit ma-1"
                        title="Edit"
                        @click="editDataModel(singleData, 'Edit Info')"
                      >
                        <v-icon small>mdi-pencil-outline</v-icon>
                      </v-btn>
                      <v-btn
                        small
                        text
                        icon
                        class="btn_delete ma-1"
                        title="Edit"
                        @click="deleteData(singleData.id)"
                      >
                        <v-icon small>mdi-delete-empty</v-icon>
                      </v-btn>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
            <div v-else>
              <tbl-data-loader v-if="dataLoading" />
            </div>
            <div>
              <span>Total Records: {{ totalValue }}</span>
            </div>
            <pagination
              :data="allData"
              @pagination-change-page="getResults"
              class="justify-content-end"
            >
              <span slot="prev-nav">&lt; Previous</span>
              <span slot="next-nav">Next &gt;</span>
            </pagination>
          </div>
          <data-not-available v-if="!totalValue && !dataLoading" />
        </v-card-text>
      </v-card>

      <!-- data modal start -->
      <v-dialog v-model="dataModal">
        <v-card>
          <v-card-title class="justify-center">
            <v-row>
              <v-col cols="10">{{ dataModelTitle }}</v-col>
              <v-col cols="2">
                <v-btn
                  @click="dataModal = false"
                  color="btn_close lighten-1 white--text"
                  small
                  class="float-right"
                >
                  <v-icon left dark>mdi-close</v-icon>Close
                </v-btn>
              </v-col>
            </v-row>
          </v-card-title>

          <v-card-text>
            <form @submit.prevent="editmode ? updateData() : createData()">
              <v-row>
                <v-col cols="4" lg="3" md="6">
                  <v-text-field
                    v-model="form.name"
                    label="Pet Name"
                    :error-messages="form.errors.get('name')"
                  ></v-text-field>
                </v-col>

                <v-col cols="4" lg="3" md="6">
                  <v-radio-group v-model="form.gender"
                      label="Pet Gender" row :error-messages="form.errors.get('gender')">
                      <v-radio label="Male" :value="1"></v-radio>
                      <v-radio label="Female" :value="2"></v-radio>
                  </v-radio-group>
                </v-col>

                <v-col cols="4" lg="3" md="6">
                  <v-text-field
                    v-model="form.color"
                    label="Pet Color"
                    :error-messages="form.errors.get('color')"
                  ></v-text-field>
                </v-col>

                <v-col cols="4" lg="3" md="6">
                  <v-text-field
                    v-model="form.weight"
                    label="Weight"
                    :error-messages="form.errors.get('weight')"
                  ></v-text-field>
                </v-col>

                <v-col cols="4" lg="3" md="6">
                  <v-text-field
                    v-model="form.reward"
                    label="Reward"
                    :error-messages="form.errors.get('reward')"
                  ></v-text-field>
                </v-col>

                <v-col cols="4" lg="3" md="6">
                  <v-text-field
                    v-model="form.lost_location"
                    label="Lost Location"
                    :error-messages="form.errors.get('lost_location')"
                  ></v-text-field>
                </v-col>

                <v-col cols="4" lg="3" md="6">
                  <v-text-field
                    v-model="form.contact_info"
                    label="Contact Information"
                    :error-messages="form.errors.get('contact_info')"
                  ></v-text-field>
                </v-col>

                <v-col cols="4" lg="3" md="6">
                  <v-text-field
                    v-model="form.note"
                    label="Note"
                    :error-messages="form.errors.get('note')"
                  ></v-text-field>
                </v-col>

                <!-- Image -->
                <v-col cols="12" lg="6" md="6">
                    <v-file-input prepend-icon="mdi-camera"
                    hint="Dimention:260x260px" persistent-hint show-size truncate-length="15" small-chips @change="uploadImageByName($event, 'image', ['jpg', 'png', 'jpeg'])"
                        label="Choose Pet Picture" size="sm" accept=".jpg, .png, .jpeg" :error-messages="form.errors.get('image')">
                    </v-file-input>
                </v-col>

                <v-col cols="12" lg="6" md="6">
                  <img :src="showImageByName('image')"
                      class="rounded mx-auto d-block image-thum-size" />
                </v-col>
                <hr>

                <v-btn
                  v-show="editmode"
                  type="submit"
                  block
                  class="my-2 btn_update"
                  :loading="dataLodaing"
                ><v-icon left>{{ customIcon.update }}</v-icon>Update</v-btn>
                <v-btn
                  v-show="!editmode"
                  type="submit"
                  block
                  class="my-2 btn_save"
                  :loading="dataLodaing"
                ><v-icon left>{{ customIcon.save }}</v-icon>Create</v-btn>
              </v-row>
            </form>
          </v-card-text>
        </v-card>
      </v-dialog>

      <!-- view data modal start -->
      <v-dialog v-model="viewDataModal" width="800">
        <v-card>
            <v-card-title class="justify-center">
                <v-row>
                <v-col cols="10">Flyer</v-col>
                <v-col cols="2">
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
                <div class="flyerdesigner">
                  <div class="flyerheader">
                      <h1 class="flyertitle">Missing Dog</h1>
                  </div>
                  <div class="flyerbody">
                      <div class="flyerpetphoto">
                          <img :src="imagePath + detailsData.image" alt="Missing Pet">
                      </div>
                      <div class="flyerpetdetails">
                          <h2 class="flyerpetname">{{ detailsData.name }}</h2>
                          <p><span class="flyerdtitle">Sex: </span> {{ (detailsData.gender == 1) ? 'Male' : 'Female' }}</p>
                          <p><span class="flyerdtitle">Color: </span> {{ detailsData.color }}</p>
                          <p><span class="flyerdtitle">Weight: </span> {{ detailsData.weight }} kg</p>
                          <p class="whereitslost"><span class="flyerdtitle">Lost Location: </span> {{ detailsData.lost_location }}</p>
                          <div class="findreward">
                            <h1 class="rewardamount">${{ detailsData.reward }}</h1>
                            <h2 class="rewardtitle">Reward</h2>
                        </div>
                      </div>
                  </div>
                  <div class="flyerfooter">
                      <h3 class="flyerfooternote">{{ detailsData.note }}</h3>
                      <h1 class="flyercontact">{{ detailsData.contact_info }}</h1>
                  </div>
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
          currentUrl: "/losting_pet",
          imagePath: "/images/backend/pet/",
          imagePathSm: "/images/backend/pet/small/",

            // Form
            form: new Form({
                id: "",
                name: "",
                color: "",
                gender: "",
                weight: "",
                reward: "",
                lost_location: "",
                contact_info: "",
                note: "Call or text with any information",
                image: "",
            }),

            viewDataModal:false,
            detailsData:[],
          
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

        viewDetails(val){
          this.detailsData = val;
          this.viewDataModal = true;
        },
      },
  
      computed: {
        
      },
  
      async mounted() {
        this.$Progress.start();
        await this.getResults();
        this.$Progress.finish();
      },
  
      created(){
  
      },
  
  };
  </script>
  <style scoped>
    .image-thum-size {
      height: 80px;
      width: 80px;
    }

    *{font-family: 'Poppins', sans-serif;}

    /*Lost Pet Flyer*/
    .flyerdesigner{width:100%; max-width:700px;padding-top:0;}
    .flyerheader{background:#eb2411;padding:10px 0; border-radius:5px;}
    .flyertitle{text-align:center;color:#fff;margin:0;text-transform:uppercase;font-size: 75px; font-weight: bold;}
    .flyerpetphoto{width:60%;float:left;}
    .flyerpetphoto img{width:100%;height:500px;object-fit:cover;border-radius:5px;box-shadow:0 0 10px #333;}
    .flyerpetdetails{width:40%; float:right;}

    .flyerbody{display:flex;padding: 20px 10px 10px;}
    .flyerpetdetails{padding-left:20px;}
    .flyerpetname{font-size:35px; text-transform:uppercase;color:#eb2411;margin:0;font-weight: bold; line-height: 53px;}
    .flyerpetdetails p{margin-bottom:0;font-weight:300;margin-top: 7px;font-size:22px; line-height: 33px;}
    p.whereitslost{height:148px;overflow:hidden;}
    .flyerdtitle{color:#eb2411;font-weight:600;}

    .findreward{background:#000;padding:20px 10px;border-radius: 5px;margin-top: 10px;}
    .rewardamount{text-align:center;color:#fff;font-size:69px;text-transform:uppercase;margin:0;line-height: 63px;font-weight: bold;}
    .rewardtitle{text-align:center;color:#fff;font-size:40px;text-transform:uppercase;margin-bottom:5px;margin-top:20px;line-height: 30px;font-weight: bold;}
    .flyerfooter{background:#9d0e00;padding:10px 0; border-radius:5px;margin:0;}
    .flyerfooternote{font-size:22px;font-weight:300;text-align:center;color:#fff;margin:0;}
    .flyercontact{font-size:92px;text-align:center;color:#fff;margin:0;line-height: 76px; font-weight: bold;}
    .downloadflyer{width:200px; margin-top:30px; margin-left:auto;margin-right:auto; margin-bottom:20px;text-align: center;}
    #previewImg{display:none}

    /*Lost Pet Flyer*/
    .flyerpetfoundphoto{width:60%;float:left;}
    .flyerpetfoundphoto img{width:100%;height:330px;object-fit:cover;border-radius:5px;box-shadow:0 0 10px #333;}
</style>