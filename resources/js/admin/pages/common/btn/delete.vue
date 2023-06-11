<template>
  <span v-if="Permit">
    <v-btn
      v-if="Permit && isPermit(Permit)"
      @click="$emit('trigerModel')"
      icon
      class="ma-1 btn_delete_color"
      :title="customTitle.delete"
    >
      <v-icon>{{ customIcon.delete }}</v-icon>
    </v-btn>
  </span>
  <span v-else>
    <v-btn
      @click="$emit('trigerModel')"
      icon
      class="ma-1 btn_delete_color"
      :title="customTitle.delete"
    >
      <v-icon>{{ customIcon.delete }}</v-icon>
    </v-btn>
  </span>
</template>

<script>
export default {
  props: ["Permit"]
};
</script>