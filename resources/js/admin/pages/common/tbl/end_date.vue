<template>
    <v-menu v-model="menu" min-width="auto" :close-on-content-click="false">
        <template v-slot:activator="{ on, attrs }">
            <v-text-field :value="endDate" label="End Date" prepend-icon="mdi-calendar"
              readonly v-bind="attrs" v-on="on" title="End Date">
            </v-text-field>
        </template>
  
        <v-date-picker
            v-model="end_date"
            no-title
            @input="menu = false"
            @change="$emit('trigerValue','end_date',end_date)"
        >
        </v-date-picker>
    </v-menu>
</template>
    
<script>
    export default {
      data() {
        return {
          //date picker
          end_date: this.$moment(new Date()).format("YYYY-MM-DD"),
          menu: false,
        };
      },
      computed: {
        endDate(){
          return this.end_date ? this.$moment(this.end_date).format('DD/MM/YYYY') : ''
        },
      },
    };
</script>