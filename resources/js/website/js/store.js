import Vue from 'vue'
import Vuex from 'vuex'
Vue.use(Vuex)

export default new Vuex.Store({

    state : {
        auth : null,
        certification : null,
    },

    getters : {

        getAuth(state){
            return state.auth;
        },

        getCertification(state){
            return state.certification;
        },

    },

    mutations : {

        // Auth User
        setAuth(state, data){
            state.auth = data;
        },

        setCertificate(state, data){
            state.certification = data;
        },

    },

    actions :  {

    },

});
