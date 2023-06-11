<template>
  <span v-if="Permit">
    <v-btn
      v-if="Status"
      @click="$emit('trigerModel')"
      icon
      class="ma-1 btn_active_color"
      :title="customTitle.active"
      style="pointer-events: none"
      :style="isPermit(Permit) ? 'pointer-events: auto;' : 'pointer-events: none'"
    >
      <v-icon>{{ customIcon.active }}</v-icon>
    </v-btn>

    <v-btn
      v-else
      @click="$emit('trigerModel')"
      icon
      class="ma-1 btn_inactive_color"
      :title="customTitle.inactive"
      :style="isPermit(Permit) ? 'pointer-events: auto;' : 'pointer-events: none'"
    >
      <v-icon>{{ customIcon.inactive }}</v-icon>
    </v-btn>

    <!-- <v-switch
      v-if="childStatus"
      v-model="childStatus"
      @click="$emit('trigerModel')"
      class="p-0 btn"
      :title="customTitle.active"
      :style="isPermit(Permit) ? 'pointer-events: auto;' : 'pointer-events: none'"
    ></v-switch>

    <v-switch
      v-else
      v-model="childStatus"
      @click="$emit('trigerModel')"
      class="p-0 btn"
      :title="customTitle.inactive"
      :style="isPermit(Permit) ? 'pointer-events: auto;' : 'pointer-events: none'"
    ></v-switch> -->

  </span>
  <span v-else>
    <v-btn
      v-if="Status"
      @click="$emit('trigerModel')"
      small
      elevation="10"
      class="ma-1 btn_active"
      :title="customTitle.active"
      style="pointer-events: none"
    >
      <v-icon>{{ customIcon.active }}</v-icon>
    </v-btn>
    
    <v-btn
      v-else
      @click="$emit('trigerModel')"
      small
      elevation="10"
      class="ma-1 btn_inactive"
      :title="customTitle.inactive"
    >
      <v-icon>{{ customIcon.inactive }}</v-icon>
    </v-btn>
  </span>
</template>

<script>
export default {
  props: ["Status", "Permit"],
  data() {
    return {
      childStatus: this.Status,
    }
  },
};
</script>