<template>
    <div>
        <v-btn
            v-scroll="onScroll"
            v-show="fab"
            fab
            dark
            fixed
            bottom
            right
            @click="toTop"
            class="scroll-up"
            small
            style="text-decoration: none;"
        >
            <v-icon>mdi-chevron-up</v-icon>
        </v-btn>
      
    </div>
</template>
  
<script>
export default {
    data () {
        return {
            fab: false,
        }
    },
  
    methods: {
        onScroll (e) {
            if (typeof window === 'undefined') return
            const top = window.pageYOffset ||   e.target.scrollTop || 0
            this.fab = top > 20
        },

        toTop () {
            this.$vuetify.goTo(0)
        }
    },
  
    created(){
          
    }
}
</script>

<style scoped>
    .scroll-up{
        border-radius: 50% !important;
        background: #f44336 !important;
    }
</style>