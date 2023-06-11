<template>
  <!-- Show -->
  <v-autocomplete
    :prepend-icon="customIcon.dataShow"
    v-model="customPaginateValue"
    @change="$emit('trigerValue','paginate',customPaginateValue)"
    label="Show:"
    :items="tblItemNumberShow"
    :title="customTitle.dataShow"
    small
  ></v-autocomplete>
</template>

<script>
export default {
  data() {
    return {
      customPaginateValue: 10
    };
  }
};
</script>