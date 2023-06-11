<template>
  <!-- Search  -->
  <v-text-field
    :prepend-icon="customIcon.search"
    label="Search:"
    v-model="customValue"
    @input="$emit('trigerValue','search',customValue)"
    placeholder="Search by any data at the table..."
    :title="customTitle.search"
    clearable
  ></v-text-field>
</template>

<script>
export default {
  data() {
    return {
      customValue: ""
    };
  }
};
</script>