<template>
  <span v-if="Permit">
    <v-btn
      @click="$emit('trigerModel')"
      icon
      large
      class="float-right btn_add_color ma-1"
      v-if="isPermit(Permit)"
      :title="customTitle.add"
    >
      <v-icon>{{ customIcon.add }}</v-icon>
    </v-btn>
  </span>
  <span v-else>
    <v-btn
      @click="$emit('trigerModel')"
      icon
      large
      class="float-right btn_add_color ma-1"
      :title="customTitle.add"
    >
      <v-icon>{{ customIcon.add }}</v-icon>
    </v-btn>
  </span>
</template>

<script>
export default {
  props: ["Permit"]
};
</script>