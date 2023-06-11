<template>
  <div>
    <v-card>
      <v-card-title class="justify-center">
        <v-row>
          <v-col cols="10">All Roles List</v-col>
          <v-col cols="2">
            <!-- add btn component -->
            <btn-component-add
              Permit="administrator"
              @trigerModel="addDataModel('Add New Role')"
            />
          </v-col>
        </v-row>
      </v-card-title>

      <v-card-text>
        <div>
          <!-- global filter bar component -->
          <v-row>
            <v-col cols="2">
              <!-- data-show-per-page -->
              <data-show-per-page @trigerValue="customValeSet" />
            </v-col>
            <v-col cols="10">
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
                  <th>
                    <a href="#" @click.prevent="change_sort('name')"
                      >Role Name</a
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
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="singleData in allData.data" :key="singleData.id">
                  <td>{{ singleData.id }}</td>
                  <td>
                    {{ singleData.name }}<br>
                    <v-chip class="m-1">
                      {{ singleData.slug }}
                    </v-chip>
                  </td>
                  <td class="text-center" v-if="!singleData.used_role">
                    <btn-component-edit
                      Permit="administrator"
                      @trigerModel="editDataModel(singleData, 'Edit Contact Info')"
                    />
                    <btn-component-delete
                      Permit="administrator"
                      @trigerModel="deleteData(singleData.id)"
                    />
                  </td>
                  <td v-else>
                    <span class="text-danger"> Role Already Assigned </span>
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
            <v-text-field
              v-model="form.name"
              label="Enter Role Name"
              :error-messages="form.errors.get('name')"
            ></v-text-field>

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
      currentUrl: "/admin/role",

      // Form
      form: new Form({
        id: "",
        name: "",
      }),

    };
  },

  methods:{

  },

  async mounted() {
    this.$Progress.start();
    // Fetch initial results
    await this.getResults();
    await this.$Progress.finish();

  }
};
</script>

<style>
    /* vuetify pagination css */
		.v-pagination__item {
			background-color: #5cb85c !important;
			color: white !important;
			border-color: #5cb85c !important;
		}

    .v-pagination__item:hover{
			background-color: #000 !important;
			color: white !important;
      transition: all 0.3s ease-out;
		}

    .v-pagination__item:focus {
			background-color: red !important;
			color: white !important;
      text-decoration: underline;
		}

</style>
