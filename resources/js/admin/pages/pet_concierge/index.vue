<template>
  <div>
    <v-card>
      <v-card-title class="justify-center">
        <v-row>
          <v-col cols="6" sm="10" lg="10" md="10">All Pet Concierge List
          </v-col>
          <v-col cols="6" sm="2" lg="2" md="2">
            <!-- add btn component -->
            <btn-component-add
              Permit=""
              @trigerModel="addDataModel('Add New Concierge')"
            />
          </v-col>
        </v-row>
      </v-card-title>

      <v-card-text>
        <div>

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
                  <th>Business Name</th>
                  <th>Contact Person</th>
                  <th>Address</th>
                  <th>Phone Number</th>
                  <th>Website</th>
                  <th>Email</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody class="linkstyle">
                <tr v-for="(singleData ,i) in allData.data" :key="i">
                  <td>{{ ++i }}</td>
                  <td>{{ singleData.business_name }}</td>
                  <td>{{ singleData.contact_person }}</td>
                  <td><a :href="singleData.address_map" target="_blank">{{ singleData.address }}</a></td>
                  <td><a :href="'tel:'+singleData.phone_no">{{ singleData.phone_no }}</a></td>
                  <td><a :href="singleData.website" target="_blank">{{ singleData.website }}</a></td>
                  <td><a :href="'mailto:'+singleData.email" target="_top">{{ singleData.email }}</a></td>
                  <td class="text-center">
                    <v-btn
                        small
                        text
                        icon
                        class="btn_details ma-1"
                        title="View"
                        @click="viewDetails(singleData)"
                    >
                        <v-icon small>mdi-eye</v-icon>
                    </v-btn>
                    <btn-component-edit
                      Permit=""
                      @trigerModel="editDataModel(singleData, 'Edit Info')"
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
                    v-model="form.business_name"
                    label="Business Name"
                    :error-messages="form.errors.get('business_name')"
                  ></v-text-field>
                </v-col>

                <v-col cols="4" lg="3" md="6">
                  <v-text-field
                    v-model="form.contact_person"
                    label="Contact Person"
                    :error-messages="form.errors.get('contact_person')"
                  ></v-text-field>
                </v-col>

                <v-col cols="4" lg="3" md="6">
                  <v-text-field
                    v-model="form.address"
                    label="Address"
                    :error-messages="form.errors.get('address')"
                  ></v-text-field>
                </v-col>

                <v-col cols="4" lg="3" md="6">
                  <v-text-field
                    v-model="form.address_map"
                    label="Address Google Map"
                    :error-messages="form.errors.get('address_map')"
                  ></v-text-field>
                </v-col>

                <v-col cols="4" lg="4" md="6">
                  <v-text-field
                    v-model="form.phone_no"
                    label="Phone No"
                    :error-messages="form.errors.get('phone_no')"
                  ></v-text-field>
                </v-col>

                <v-col cols="4" lg="4" md="6">
                  <v-text-field
                    v-model="form.website"
                    label="Website"
                    :error-messages="form.errors.get('website')"
                  ></v-text-field>
                </v-col>

                <v-col cols="4" lg="4" md="6">
                  <v-text-field
                    v-model="form.email"
                    label="Email"
                    :error-messages="form.errors.get('email')"
                  ></v-text-field>
                </v-col>

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
      <v-dialog v-model="viewDataModal" width="auto">
        <v-card>
            <v-card-title class="justify-center">
                <v-row>
                <v-col cols="10">Pet Concierge</v-col>
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
              <div class="petconcierge">
                <div class="petconciergebody">
                    <div class="petconciergedetails">
                        <p><span class="petconciergetitle">Business Name: </span> {{ detailsData.business_name }}</p>
                        <p><span class="petconciergetitle">Contact Person: </span> {{ detailsData.contact_person }}</p>
                        <p><span class="petconciergetitle">Address: </span> {{ detailsData.address }}</p>
                        <p><span class="petconciergetitle">Phone No: </span> {{ detailsData.phone_no }}</p>
                        <p><span class="petconciergetitle">Website: </span> {{ detailsData.website }}</p>
                        <p><span class="petconciergetitle">Email: </span> {{ detailsData.email }}</p>
                    </div>
                </div>
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
      currentUrl: "/petConcierge",

      // Form
      form: new Form({
          id: "",
          business_name: "",
          contact_person: "",
          address: "",
          address_map: "",
          phone_no: "",
          website: "",
          email: "",
      }),

      viewDataModal:false,
      detailsData:[],

    };
  },

  methods:{
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

  async mounted() {
    this.$Progress.start();
    await this.getResults();
    this.$Progress.finish();
  }

};
</script>

<style scoped>
  .linkstyle a{
    text-decoration: none;
  }
  *{font-family: 'Poppins', sans-serif;}
  .petconcierge{width:100%; max-width:700px;padding-top:0;}
  .petconciergedetails{float:right;}
  .petconciergebody{display:flex;padding: 20px 10px 10px;}
  .petconciergedetails{padding-left:20px;}
  .petconciergedetails p{margin-bottom:0;font-weight:300;margin-top: 7px;font-size:22px; line-height: 33px;}
  .petconciergetitle{color:#eb2411;font-weight:600;}
</style>
