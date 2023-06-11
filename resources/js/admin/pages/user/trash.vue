<template>
    <div>
      <v-card>
        <v-card-title class="justify-center">
          <v-row>
            <v-col cols="12">All Deleted Users List
            </v-col>
          </v-row>
        </v-card-title>

        <v-card-text>
          <div>
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

            <v-menu
                bottom
                origin="center center"
                transition="scale-transition"
            >
                <template v-slot:activator="{ on, attrs }">
                  <v-btn
                    color="primary"
                    dark
                    v-bind="attrs"
                    v-on="on"
                    :disabled="!isSelected"
                  >
                    Bulk Options
                  </v-btn>
                </template>

                <v-list>
                  <v-list-item>
                    <v-btn @click="deleteAll(selected)" small class="ma-1 error">
                      <v-icon left>mdi-delete-empty-outline</v-icon>Delete All
                    </v-btn>
                  </v-list-item>
                </v-list>
            </v-menu>

            <div class="table-responsive" v-if="!dataLoading && allData.data">
              <table class="table table-bordered text-center">
                <thead>
                  <tr>
                    <th>
                      <v-checkbox @click="checkedAll()" v-model="selectedAll"></v-checkbox>
                    </th>
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
                    <th>
                      <a href="#" @click.prevent="change_sort('email')"
                        >Email</a
                      >
                      <span
                        v-if="
                          sort_direction == 'desc' && sort_field == 'email'
                        "
                        >&uarr;</span
                      >
                      <span
                        v-if="
                          sort_direction == 'asc' && sort_field == 'email'
                        "
                        >&darr;</span
                      >
                    </th>
                    <th>
                      <a href="#" @click.prevent="change_sort('mobile_no')"
                        >Mobile Number</a
                      >
                      <span
                        v-if="
                          sort_direction == 'desc' && sort_field == 'mobile_no'
                        "
                        >&uarr;</span
                      >
                      <span
                        v-if="
                          sort_direction == 'asc' && sort_field == 'mobile_no'
                        "
                        >&darr;</span
                      >
                    </th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="singleData in allData.data" :key="singleData.id">
                    <td><v-checkbox :value="singleData.id" v-model="selected"></v-checkbox></td>
                    <td>{{ singleData.id }}</td>
                    <td>{{ singleData.name }}</td>
                    <td>{{ singleData.email }}</td>
                    <td>{{ singleData.mobile_no }}</td>
                    <td class="text-center">
                        <v-btn @click="restoreUser(singleData.id)" color="btn_active"
                            depressed small>
                            <v-icon small left>mdi-check-circle-outline</v-icon> Restore
                        </v-btn>

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
        currentUrl: "/admin/user",

        // Form
        form: new Form({
          id: "",
        }),

        selected:[],
        selectedAll: false,
        isSelected: false,

      };
    },

    watch:{
      selected: function (selected) {
          this.isSelected = (selected.length > 0);
          this.selectedAll = (selected.length == this.allData.data.length);
      },
    },

    methods:{

        // Get table data
        getResults(page = 1) {
            this.dataLoading = true;
            axios.get(this.currentUrl+'/temp_deleted_user?page=', {
              params: {
                page:page,
                paginate: this.paginate,
                search: this.search,
                sort_direction: this.sort_direction,
                sort_field: this.sort_field,
                search_field: this.search_field,
              }

            }).then(response => {
                //console.log(response.data.data);
                //console.log(response.data.from, response.data.to, response.data.current_page);
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

        //restore user
        restoreUser(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to restore this user?",
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, restore it!'
            }).then((result) => {

                // Send request to the server
                if (result.value) {
                    //console.log(id);
                    this.$Progress.start();
                    axios.get(this.currentUrl + '/restore_user/' + id).then((response) => {
                        //console.log(response);
                        Swal.fire(
                            'Restored!',
                            'Your file has been restored.',
                            'success'
                        );
                        // Refresh Tbl Data with current page
                        this.getResults(this.currentPageNumber);
                        this.$Progress.finish();

                    }).catch((data) => {
                        Swal.fire({
                            icon: 'error',
                            title: 'Somthing Going Wrong<br>'+data.message,
                            customClass: 'text-danger'
                        });
                        // Swal.fire("Failed!", data.message, "warning");
                    });
                }
            })
        },

    },

    mounted() {
      this.$Progress.start();
      // Fetch initial results
      this.getResults();
      this.$Progress.finish();
    }

  };
  </script>

  <style scoped>

  </style>