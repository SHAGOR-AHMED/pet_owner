<template>
  <div>
    <v-card>
      <v-card-title class="justify-center">
        <v-row>
          <v-col cols="6" sm="10" lg="10" md="10">All Marker List
          </v-col>
          <v-col cols="6" sm="2" lg="2" md="2">
            <!-- add btn component -->
            <btn-component-add
              Permit=""
              @trigerModel="addDataModel('Add New Marker')"
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
                  <th>Text</th>
                  <th>Owner</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="singleData in allData.data" :key="singleData.id">
                  <td>{{ singleData.id }}</td>
                  <td>{{ singleData.text }}</td>
                  <td>{{ singleData.users.name }}</td>
                  <td class="text-center">
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
    <v-dialog v-model="dataModal" width="600"> 
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

              <v-col cols="12" lg="12" md="12">
                <v-autocomplete :items="allPetOwners" v-model="form.owner_id" item-text="name" item-value="id" label="Pet Owner" placeholder="Select Pet Owner" :error-messages="form.errors.get('owner_id')"></v-autocomplete>
              </v-col>

              <v-col cols="12" lg="12" md="12">
                <v-textarea
                  v-model="form.text"
                  label="text"
                  :rules="textRules"
                  :error-messages="form.errors.get('text')"
                ></v-textarea>
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
      currentUrl: "/admin/marker",

      textRules: [
        v => !!v || 'Name is required',
      ],

      // Form
      form: new Form({
        id: "",
        owner_id: "",
        text: "",
      }),

      allPetOwners:[],

    };
  },

  methods:{
    getPetOwner(){
      return axios.get(this.currentUrl + '/get_pet_owner').then(response =>{
        this.allPetOwners = response.data; 
      })
    },
  },

  async mounted() {
    this.$Progress.start();
    await this.getResults();
    await this.getPetOwner();
    this.$Progress.finish();
  }

};
</script>

<style scoped>

</style>
