<template>
  <span v-if="Permit">
    <v-btn
      v-if="isPermit(Permit)"
      @click="$emit('trigerModel')"
      icon
      class="ma-1 btn_edit_color"
      :title="customTitle.edit"
    >
      <v-icon>{{ customIcon.edit }}</v-icon>
    </v-btn>
  </span>
  <span v-else>
    <v-btn
      @click="$emit('trigerModel')"
      icon
      class="ma-1 btn_edit_color"
      :title="customTitle.edit"
    >
      <v-icon>{{ customIcon.edit }}</v-icon>
    </v-btn>
  </span>
</template>

<script>
export default {
  props: ["Permit"]
};
</script>