<template>
    <div>
        <div>
            <div class="marker">
                <iframe :src="marker.text + '&amp;single=true&amp;widget=true&amp;headers=false'"></iframe>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                marker:{},
            }
        },

        methods: {
            getMarker(){
                axios.get('/admin/marker/get_marker_by_id').then(response =>{
                    this.marker = response.data; 
                })
            },
        },

        created(){
            this.$Progress.start();
            this.getMarker();
            this.$Progress.finish();
        }
    }
</script>

<style scoped>
*{font-family: 'Poppins', sans-serif;}
.marker{width:100%; min-width:600px; padding:30px;}
.marker iframe{width: 100%; height: 500px;}
</style>