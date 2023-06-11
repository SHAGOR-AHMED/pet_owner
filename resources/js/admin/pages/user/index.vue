<template>
  <div>
    <v-card>
      <v-card-title class="justify-center">
        <v-row>
          <v-col cols="6" sm="10" lg="10" md="10">All Users List
          </v-col>
          <v-col cols="6" sm="2" lg="2" md="2">
            <!-- add btn component -->
            <btn-component-add
              Permit=""
              @trigerModel="addDataModel('Add New User')"
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
              <v-list-item>
                <v-btn @click="statusActiveAll(selected)" small class="ma-1 success"
                      depressed>
                  <v-icon left>mdi-check-circle-outline</v-icon>Active All
                </v-btn>
              </v-list-item>
              <v-list-item>
                <v-btn @click="statusDeactiveAll(selected)" small class="ma-1 warning"
                      depressed>
                  <v-icon left>mdi-alert-circle-outline</v-icon>Deactive All
                </v-btn>
              </v-list-item>
            </v-list>
          </v-menu>

          <div class="table-responsive" v-if="!dataLoading && allData.data">
            <table class="table table-bordered text-center">
              <thead>
                <tr>
                  <th>
                      <v-checkbox @click="checkedAll()" dense v-model="selectedAll"></v-checkbox>
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
                  <td>
                    {{ singleData.name }}
                    <span>
                      <v-chip class="m-1">
                        {{ (singleData.u_type == 'sa') ? 'Admin' : 'Pet Owner' }}
                      </v-chip>
                    </span>
                  </td>
                  <td>{{ singleData.email }}</td>
                  <td>{{ singleData.mobile_no }}</td>
                  <td class="text-center">

                    <btn-component-active-inactive
                      Permit=""
                      @trigerModel="statusChange(singleData)"
                      :Status="singleData.status"
                    />
                    <btn-component-edit
                      Permit=""
                      @trigerModel="editDataModel(singleData, 'Edit User Info')"
                    />
                    <btn-component-delete
                      Permit=""
                      @trigerModel="deleteDataTemp(singleData.id)"
                    />

                    <!-- <v-btn
                      @click="editRoleModel(singleData)"
                      elevation="10"
                      small
                      class="btn_role ma-1"
                      :title="customTitle.role"
                    >
                      <v-icon>{{ customIcon.role }}</v-icon>
                    </v-btn> -->

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
    <v-dialog v-model="dataModal" width="900">
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
              <v-col cols="4" lg="4" md="6">
                <v-text-field
                  v-model="form.name"
                  label="Enter Full Name"
                  :rules="nameRules"
                  :error-messages="form.errors.get('name')"
                ></v-text-field>
              </v-col>

              <v-col cols="4" lg="4" md="6">
                <v-text-field
                  v-model="form.email"
                  label="Enter Email"
                  :rules="emailRules"
                  :error-messages="form.errors.get('email')"
                ></v-text-field>
              </v-col>

              <v-col cols="4" lg="4" md="6">
                <v-text-field
                  v-model="form.mobile_no"
                  label="Enter Mobile Number"
                  :rules="numberRule"
                  :error-messages="form.errors.get('mobile_no')"
                ></v-text-field>
              </v-col>

              <v-col cols="4" lg="4" md="6">
                <v-radio-group v-model="form.u_type"
                    label="User Type" row :error-messages="form.errors.get('u_type')">
                    <v-radio label="Admin" value="sa"></v-radio>
                    <v-radio label="Pet Owner" value="po"></v-radio>
                </v-radio-group>
              </v-col>

              <v-col cols="4" lg="4" md="6" v-if="!editmode">
                <v-text-field
                  v-model="form.password"
                  label="Enter Password"
                  :rules="passwordRules"
                  :error-messages="form.errors.get('password')"
                  :append-icon="show1 ? 'mdi-eye' : 'mdi-eye-off'"
                  :type="show1 ? 'text' : 'password'"
                  hint="At least 6 characters"
                  counter
                  @click:append="show1 = !show1"
                ></v-text-field>
              </v-col>

              <v-col cols="4" lg="4" md="6" v-if="!editmode">
                <v-text-field
                  v-model="form.password_confirmation"
                  label="Enter Confirm Password"
                  :append-icon="show2 ? 'mdi-eye' : 'mdi-eye-off'"
                  :type="show2 ? 'text' : 'password'"
                  hint="At least 6 characters"
                  counter
                  @click:append="show2 = !show2"
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

    <!-- role model start -->
    <v-dialog v-model="roleDataModal" v-if="roleDataModal" >
      <v-card>
        <v-card-title class="justify-center">
          <v-row>
            <v-col cols="10">Assign Role</v-col>
            <v-col cols="2">
              <v-btn
                @click="roleDataModal = false"
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
          <form @submit.prevent="updateRoleData()">
            <v-row>
                <div class="accordion" id="accordionPanelsStayOpenExample">
                  <v-row>
                    <v-col
                      cols="6"
                      lg="4"
                      v-for="(role, index) in allRoles"
                      :key="index"
                    >
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                          <button class="accordion-button" type="button" data-bs-toggle="collapse" :data-bs-target="'#collapse_' + index">
                            {{ role[0].key_name }}
                          </button>
                        </h2>
                        <div :id="'collapse_' + index" class="accordion-collapse collapse" :class="checkCollaps(role)" aria-labelledby="panelsStayOpen-headingOne">
                          <div class="accordion-body">
                            <v-row>
                              <v-col
                                cols="2"
                                lg="3"
                                v-for="(action, index) in role"
                                :key="index"
                              >
                                <v-checkbox
                                  v-model="form.role_id"
                                  :label="action.new_text"
                                  :value="action.id"
                                  color="success"
                                  hide-details
                                ></v-checkbox>
                              </v-col>
                            </v-row>
                          </div>
                        </div>
                      </div>
                    </v-col>

                  </v-row>
                </div>

                <v-btn
                  type="submit"
                  block
                  class="my-2 btn_update"
                  :loading="dataLodaing"
                ><v-icon left>{{ customIcon.update }}</v-icon>Update
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
import axios from 'axios';
export default {
  data() {
    return {
      //current page url
      currentUrl: "/admin/user",

      imagePathSm: "/images/backend/admin/small/",
      imagePath: "/images/backend/admin/",
      imageMaxSize: "2111775",

      show1: false,
      show2: false,

      nameRules: [
        v => !!v || 'Name is required',
      ],

      passwordRules: [
        v => !!v || 'Password is required',
        v => v.length >= 6 || 'Min 6 characters',
      ],

      numberRule:[
        v => !!v || 'Mobile Number is Required.',
        v => Number.isInteger(Number(v)) || "The value must be an integer number",
        v => /(01)/.test(v) || 'Mobile number is not valid',
        v => v.length == 11 || "Mobile number must be 11 digit",
      ],

      emailRules: [
        v => !!v || 'Email is required',
        v => !v || /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
      ],

      // Form
      form: new Form({
        id: "",
        name: "",
        email: "",
        mobile_no: "",
        u_type: "",
        password: "",
        password_confirmation: "",
        role_id: [],
      }),

      allRoles: [],
      selected: [],
      selectedAll: false,
      isSelected: false,
      roleDataModal: false,
      onlineUser:'',
      current_time:  this.$moment(new Date()).format("YYYY-MM-DD HH:mm"),

    };
  },

  watch:{
    selected: function (selected) {
      this.isSelected = (selected.length > 0);
      this.selectedAll = (selected.length == this.allData.data.length);
    },
  },

  methods:{

    //count total online user
    countTotalOnline(){
      axios.get(this.currentUrl + '/total_online_user').then(response => {
        this.onlineUser = response.data;
      });
    },

    // uniqueRoleName
    uniqueRoleName(val){
      //console.log('assign role:', val)
      var roleNameArr = [];
      val.forEach(ele=>{
        roleNameArr.push(ele.name.split('-')[0])
      })
      //console.log('assign role:', roleNameArr)
      //console.log('assign role:', [...new Set(roleNameArr)])
      return [...new Set(roleNameArr)];

      // let pos = ele.name.indexOf("-");
      // let action = ele.name.substr(pos+1);
      // let role = action;
      // let role_name = ele.name.split('-')[0];
      // roleArr.push(role_name);

    },

    // checkCollaps
    checkCollaps(val){
      //console.log('first:',val);
      let colllapsData = '';
      val.forEach(ele=>{
        //console.log('checkCollaps:', ele.id, this.form.role_id)
        if(this.form.role_id.includes(ele.id)){
          colllapsData = 'show';
        }
      })
      return colllapsData;
    },

    getRoles(){
      axios.get(this.currentUrl + '/get-roles').then(response => {
        this.allRoles = response.data.get_all_roles;
      });
    },

    // Edit Dynamic Role Modal
    editRoleModel(singleData) {
      this.roleDataModal = true;
      this.resetForm();
      // this.form.fill(singleData);
      this.form.id = singleData.id
      // Role
      this.form.role_id = [];
      singleData.roles.forEach((element) => {
        this.form.role_id.push(element.id);
      });
    },

    updateRoleData() {

      this.dataLodaing = true
      this.$Progress.start()
      //console.log('role:', this.form);
      axios.put(this.currentUrl + '/role-update', {data: this.form}).then(response => {
        // Input field make empty
        this.resetForm()
        // modal hide
        this.roleDataModal = false
        this.dataLodaing = false

        // Refresh Tbl Data with current page
        this.getResults(this.currentPageNumber)
        this.$Progress.finish()

        Toast.fire({
          icon: response.data.icon,
          title: response.data.msg
        });

      }).catch(error=>{
        // this.dataModal = false;
        this.dataLodaing = false;
        Swal.fire("Failed!", data.message, "warning")
      });

    },

  },

  async mounted() {
    this.$Progress.start();
    // Fetch initial results
    await this.getResults();
    await this.getRoles();
    await this.countTotalOnline();
    this.$Progress.finish();
  }

};
</script>

<style scoped>
  .image-thum-size {
      height: 80px;
      width: 80px;
  }
</style>
