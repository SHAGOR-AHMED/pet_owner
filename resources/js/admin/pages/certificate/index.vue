<template>
  <div>
    <v-card>
      <v-card-title class="justify-center">
        <v-row>
          <v-col cols="6" sm="10" lg="10" md="10">All Certificates List
          </v-col>
          <v-col cols="6" sm="2" lg="2" md="2">
            <!-- add btn component -->
            <btn-component-add
              Permit=""
              @trigerModel="addDataModel('Add New Certificate')"
            />
          </v-col>
        </v-row>
      </v-card-title>

      <v-card-text>
        <div>
          <!-- global filter bar component -->
          <v-row>
            <v-col cols="12" sm="12" lg="2" md="6">
              <!-- data-show-per-page -->
              <data-show-per-page @trigerValue="customValeSet" />
            </v-col>
            <v-col cols="12" sm="12" lg="10" md="6">
              <!-- data-search -->
              <data-search @trigerValue="customValeSet" />
            </v-col>
          </v-row>

          <div class="table-responsive" v-if="!dataLoading && allData.data">
            <table class="table table-bordered text-center">
              <thead>
                <tr>
                  <th>
                    <a href="#" @click.prevent="change_sort('id')"
                      >ID</a
                    >
                    <span
                      v-if="
                        sort_direction == 'desc' && sort_field == 'id'
                      "
                      >&uarr;</span
                    >
                    <span
                      v-if="
                        sort_direction == 'asc' && sort_field == 'id'
                      "
                      >&darr;</span
                    >
                  </th>
                  <th>Image</th>
                  <th>
                    <a href="#" @click.prevent="change_sort('name')"
                      >Name</a
                    >
                    <span
                      v-if="
                        sort_direction == 'desc' && sort_field == 'name'
                      "
                      >&uarr;</span
                    >
                    <span
                      v-if="
                        sort_direction == 'asc' && sort_field == 'name'
                      "
                      >&darr;</span
                    >
                  </th>
                  <th>Details</th>
                  <th>
                    <a href="#" @click.prevent="change_sort('breed')"
                      >Breed</a
                    >
                    <span
                      v-if="
                        sort_direction == 'desc' && sort_field == 'breed'
                      "
                      >&uarr;</span
                    >
                    <span
                      v-if="
                        sort_direction == 'asc' && sort_field == 'breed'
                      "
                      >&darr;</span
                    >
                  </th>
                  <th>
                    <a href="#" @click.prevent="change_sort('color')"
                      >Color</a
                    >
                    <span
                      v-if="
                        sort_direction == 'desc' && sort_field == 'color'
                      "
                      >&uarr;</span
                    >
                    <span
                      v-if="
                        sort_direction == 'asc' && sort_field == 'color'
                      "
                      >&darr;</span
                    >
                  </th>
                  <th>Owner</th>
                  <th>Gender</th>
                  <th>DOB</th>
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
                  <td>
                    {{ singleData.name }}<br>
                    Animal ID: {{ singleData.animal_id }}<br>
                    Code: {{ singleData.code }}
                  </td>
                  <td>
                    Sample ID: {{ singleData.sample_id }}<br>
                    Order ID: {{ singleData.order_id }}<br>
                    Report Date: {{ singleData.report_date }}
                  </td>
                  <td>{{ singleData.breed }}</td>
                  <td>{{ singleData.color }}</td>
                  <td>{{ singleData.users.name }}</td>
                  <td>{{ (singleData.gender==1) ? 'Male' : 'Female' }}</td>
                  <td>{{ singleData.dob }}</td>
                  <td class="text-center">
                    <v-btn
                        small
                        text
                        icon
                        class="btn_details ma-1"
                        title="View"
                        @click="viewDetails(singleData, singleData.users.name)"
                    >
                        <v-icon small>mdi-eye</v-icon>
                    </v-btn>
                    <btn-component-edit
                      Permit=""
                      @trigerModel="editDataModel(singleData, 'Edit User Info')"
                    />
                    <btn-component-delete
                      Permit=""
                      @trigerModel="deleteData(singleData.id)"
                    />
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <tbl-data-loader v-else />
          <div>
            <span>Total Records: {{ totalValue }}</span>
          </div>
          <v-pagination
            v-if="v_total > 1"
            circle
            v-model="currentPageNumber"
            :length="v_total"
            :total-visible="7"
            @input="getResults"
          ></v-pagination>
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
                <v-icon left dark>{{ customIcon.close }}</v-icon>Close
              </v-btn>
            </v-col>
          </v-row>
        </v-card-title>

        <v-card-text>
          <form @submit.prevent="editmode ? updateData() : createData()">
            <v-row>

              <v-col cols="4" lg="3" md="6">
                <v-text-field
                  v-model="form.animal_id"
                  label="Animal ID"
                  :error-messages="form.errors.get('animal_id')"
                ></v-text-field>
              </v-col>

              <v-col cols="4" lg="3" md="6">
                <v-text-field
                  v-model="form.code"
                  label="Biotech Pet QR Tag #"
                  :error-messages="form.errors.get('code')"
                ></v-text-field>
              </v-col>

              <v-col cols="4" lg="3" md="6">
                <v-autocomplete :items="allPetOwners" v-model="form.owner_id" item-text="name" item-value="id" label="Pet Owner" placeholder="Select Pet Owner" :error-messages="form.errors.get('owner_id')"></v-autocomplete>
              </v-col>

              <v-col cols="4" lg="3" md="6">
                <v-text-field
                  v-model="form.name"
                  label="Pet Name"
                  :rules="nameRules"
                  :error-messages="form.errors.get('name')"
                ></v-text-field>
              </v-col>

              <v-col cols="4" lg="3" md="6">
                <v-text-field
                  v-model="form.breed"
                  label="Pet Breed"
                  :error-messages="form.errors.get('breed')"
                ></v-text-field>
              </v-col>

              <v-col cols="4" lg="3" md="6">
                <v-text-field
                  v-model="form.color"
                  label="Pet Color"
                  :error-messages="form.errors.get('color')"
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
                <v-menu v-model="menu" min-width="auto">
                      <template v-slot:activator="{ on, attrs }">
                          <v-text-field v-model="form.dob" label="Pet Birth Date" prepend-icon="mdi-calendar"
                              readonly v-bind="attrs" v-on="on"></v-text-field>
                      </template>
                      <v-date-picker v-model="form.dob" no-title scrollable>
                          <v-spacer></v-spacer>
                          <v-btn text color="primary" @click="menu = false">
                              Cancel
                          </v-btn>
                      </v-date-picker>
                  </v-menu>
              </v-col>

              <v-col cols="4" lg="4" md="6">
                <v-text-field
                  v-model="form.sample_id"
                  label="Sample ID"
                  :error-messages="form.errors.get('sample_id')"
                ></v-text-field>
              </v-col>

              <v-col cols="4" lg="4" md="6">
                <v-text-field
                  v-model="form.order_id"
                  label="Order #"
                  :error-messages="form.errors.get('order_id')"
                ></v-text-field>
              </v-col>

              <v-col cols="4" lg="4" md="6">
                <v-menu v-model="menu2" min-width="auto">
                      <template v-slot:activator="{ on, attrs }">
                          <v-text-field v-model="form.report_date" label="Report Date" prepend-icon="mdi-calendar"
                              readonly v-bind="attrs" v-on="on"></v-text-field>
                      </template>
                      <v-date-picker v-model="form.report_date" no-title scrollable>
                          <v-spacer></v-spacer>
                          <v-btn text color="primary" @click="menu2 = false">
                              Cancel
                          </v-btn>
                      </v-date-picker>
                  </v-menu>
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

              <!-- Image2 -->
              <v-col cols="12" lg="6" md="6">
                  <v-file-input prepend-icon="mdi-camera"
                  hint="Dimention:850x35px" persistent-hint show-size truncate-length="15" small-chips @change="uploadImageByName($event, 'image2', ['jpg', 'png', 'jpeg'])"
                      label="Choose Color Bar" size="sm" accept=".jpg, .png, .jpeg" :error-messages="form.errors.get('image2')">
                  </v-file-input>
              </v-col>

              <v-col cols="12" lg="6" md="6">
                <img :src="showImageByName('image2')"
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
    <v-dialog v-model="viewDataModal">
      <v-card>
          <v-card-title class="justify-center">
              <v-row>
              <v-col cols="10">View Certificate</v-col>
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
            <div class="dnacertificate">
              <div class="dcb1">
                  <div class="dcb2">
                      <div class="dcb3">
                          <h1 class="certificatetitle">DNA IDENTIFICATION CERTIFICATE</h1>
                          <p class="text-center">
                              <img src="/all-assets/common/img/biotech.jpg" alt="biotech" style="max-width: 200px;">
                          </p>
                          <div class="profile-col-left">
                              <div class="petpicture">
                                <img :src="'/images/backend/certificate/small/' + detailsData.image" alt="Pet">
                                </div>
                                <div class="qr">
                                  <img src="/all-assets/common/img/qr.jpg" alt="QR Tag">
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="profile-col-right">
                              <!--<h2 class="animalidno">BICF2G630102146</h2>-->
                              <h3 class="petacareidno">BIOTECH PET QR TAG#: <strong>{{ detailsData.code }}</strong></h3>
                                <table class="animalprofiledetails">
                                  <tr>
                                      <td class="tablefieldtitle">Name:</td>
                                      <td class="tablefieldvalue">{{ detailsData.name }}</td>
                                  </tr>
                                  <tr>
                                      <td class="tablefieldtitle">Breed:</td>
                                      <td class="tablefieldvalue">{{ detailsData.breed }}</td>
                                  </tr>
                                  <tr>
                                      <td class="tablefieldtitle">Gender:</td>
                                      <td class="tablefieldvalue">{{ (detailsData.gender == 1) ? 'Male' : 'Female' }}</td>
                                  </tr>
                                  <tr>
                                      <td class="tablefieldtitle">Color</td>
                                      <td class="tablefieldvalue">{{ detailsData.color }}</td>
                                  </tr>
                                  <tr>
                                      <td class="tablefieldtitle">Birth Date:</td>
                                      <td class="tablefieldvalue">{{ detailsData.dob }}</td>
                                  </tr>
                                  <tr>
                                      <td class="tablefieldtitle">Owner:</td>
                                      <td class="tablefieldvalue">{{ ownerName }}</td>
                                  </tr>
                                </table>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                            
                            <table class="colorbararea">
                              <tr>
                                <tr>
                                    <td v-if="detailsData.image2">
                                        <img :src="'/images/backend/certificate/' + detailsData.image2" alt="ColorBar">
                                    </td>
                                     <td v-else>
                                        <img src="/all-assets/common/img/colorbar.png" alt="ColorBar">
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="certificatedisclaimer text-center">Disclaimer: Your pet's complete 200+ DNA genetic marker information can be found in your pet's <a class="link" href="#" @click="viewMarker(detailsData.owner_id)">profile</a></p>
                                    </td>
                                </tr>

                              </tr>
                            </table>
                            <table class="footerareatable">
                              <tr>
                                <td class="petacarelogoinfooter"><img src="/all-assets/common/img/PetACareCompany.png" alt="PETACARE Logo"></td>
                                <td class="footerorderdata">
                                    <p><strong>Sample ID:</strong> {{ detailsData.sample_id }}</p>
                                    <p><strong>Order #:</strong> {{ detailsData.order_id }}</p>
                                    <p><strong>Report Date:</strong> {{ detailsData.report_date }}</p>
                                </td>
                                <td class="neogenlogoinfooter"><img src="/all-assets/common/img/neogen.jpg" alt="NEOGEN Logo"></td>
                            </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
          </v-card-text>
      </v-card>
    </v-dialog>

    <!-- view data modal start -->
    <v-dialog v-model="viewDisclaimerModal">
        <v-card>
            <v-card-title class="justify-center">
                <v-row>
                    <v-col cols="10">Marker</v-col>
                    <v-col cols="2">
                        <v-btn
                            @click="viewDisclaimerModal = false"
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
                <div class="marker">
                    <iframe :src="marker.text + '&amp;single=true&amp;widget=true&amp;headers=false'"></iframe>
                </div>
            </v-card-text>
        </v-card>
    </v-dialog>

  </div>
</template>

<script>
// vform
import Form from "vform";
import axios from 'axios';
export default {
  data() {
    return {
      //current page url
      currentUrl: "/admin/certificate",

      imagePathSm: "/images/backend/certificate/small/",
      imagePath: "/images/backend/certificate/",
      imageMaxSize: "2111775",

      nameRules: [
        v => !!v || 'Name is required',
      ],

      //date picker
      dob:'',
      menu: false,
      menu2: false,

      // Form
      form: new Form({
        id: "",
        animal_id: "",
        code: "",
        owner_id: "",
        name: "",
        breed: "",
        color: "",
        gender: "",
        dob: "",
        sample_id: "",
        order_id: "",
        report_date: "",
        image: "",
        image2: "",
      }),

      allPetOwners:[],
      viewDataModal:false,
      detailsData:[],
      ownerName: "",
      viewDisclaimerModal:false,
      marker:{},

    };
  },

  methods:{
    getPetOwner(){
      axios.get('/admin/certificate/get_pet_owner').then(response =>{
        this.allPetOwners = response.data; 
      })
    },

    viewMarker(owner_id){
        axios.get('/admin/marker/get_marker_by_id/' + owner_id).then(response =>{
          this.marker = response.data; 
        })
        this.viewDataModal = false;
        this.viewDisclaimerModal = true;
    },

    viewDetails(val, val2){
        this.detailsData = val;
        this.ownerName = val2;
        this.viewDataModal = true;
    },
  },

  async mounted() {
    this.$Progress.start();
    await this.getResults();
    this.getPetOwner();
    this.$Progress.finish();
  }

};
</script>

<style scoped>
  .image-thum-size {
      height: 80px;
      width: 80px;
  }

/* CSS Document */
*{font-family: 'Poppins', sans-serif;}

.dnacertificate{width:939px; margin:50px auto; color: #000 !important;}
.dcb1{border:3px solid #3f3f3f; padding:4px;}
.dcb2{border:8px solid #040404; padding:5px;}
.dcb3{border:4px solid #4a4a4a; padding:20px 20px 5px;}
.certificatetitle{text-align:center;font-size:49px; margin-top:0;margin-bottom: 15px; font-weight: bold;}
.profile-col-left{width:45%; float:left;}
.profile-col-right{width:55%; float:right;}
.clearfix{clear:both;}
.petpicture{width:250px; height:250px; border:6px solid #1a8907;border-radius:50%;overflow: hidden;}
.petpicture img{width:100%; height:100%;object-fit:cover;}
.qr{width:118px;height:118px;border:4px solid #010300;margin-left: 213px;margin-top: -72px; position:relative;}
.qr img{width:100%;}
.animalidno{margin:0;font-size: 30px;font-weight: 700;}
.petacareidno{font-weight:500;margin: 4px 0 10px;font-size: 25px;}

.certificatedisclaimer .link{text-decoration: none;color:#ea123b;}

table{
  border-collapse: collapse;
  width: 100%;
}

.animalprofiledetails tr:nth-child(even) {
  background-color: #ddd;
}
.tablefieldtitle{/*width:120px;*/font-weight:500;}
.dnatestedornot{font-weight:500;}
.dnatestedvalue{padding-left:3px;}
.tablefieldvalue{font-weight:300;}
.animalprofiledetails td{padding: 11px 5px 8px;}

.colorbararea{margin-top:30px; }
.colorbararea img{width:100%;}
.colorbararea td,
.colorbararea th{border:0;border-spacing:0;}
.colorbararea th{font-size:10px; font-weight:400;text-align:center;}

.colorvaluea{width:100%; height:10px;background:#ffff00;display: block;border-bottom:1px solid #fff;}
.colorvaluec{width:100%; height:10px;background:#7030a0;display: block;border-bottom:1px solid #fff;}
.colorvaluet{width:100%; height:10px;background:#ed7d35;display: block;border-bottom:1px solid #fff;}
.colorvalueg{width:100%; height:10px;background:#00b04d;display: block;border-bottom:1px solid #fff;}

.marker{width:100%; min-width:600px; padding:30px; border: 1px solid #e2e2e2;}
.marker iframe{width: 100%; height: 500px;}

.footerareatable{margin-top:10px;}
.petacarelogoinfooter img{width:220px;}
.footerorderdata p{margin:0;font-size: 13px;font-weight:300;}
.footerorderdata p strong{font-weight:500;}
.neogenlogoinfooter{text-align:right;}
.neogenlogoinfooter img{width:236px;}

</style>
