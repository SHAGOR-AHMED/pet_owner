<template>
  <v-menu v-model="menu" min-width="auto" :close-on-content-click="false">
    <template v-slot:activator="{ on, attrs }">
        <v-text-field :value="startDate" label="Start Date" prepend-icon="mdi-calendar"
            readonly v-bind="attrs" v-on="on" title="Start Date"></v-text-field>
    </template>
    <!-- <v-date-picker v-model="start_date" no-title scrollable>
        <v-spacer></v-spacer>
        <v-btn text color="primary" @click="menu = false">
            Cancel
        </v-btn>
    </v-date-picker> -->

    <v-date-picker
      v-model="start_date"
      no-title
      @input="menu = false"
      @change="$emit('trigerValue','start_date',start_date)"
    >
    </v-date-picker>
  </v-menu>
</template>
  
<script>
  export default {
    data() {
      return {
        //date picker
        start_date: this.$moment(new Date()).subtract(1,'months').format("YYYY-MM-DD"),
        menu: false,
      };
    },
    computed: {
      startDate(){
        return this.start_date ? this.$moment(this.start_date).format('DD/MM/YYYY') : ''
      },
    },
  };
</script>