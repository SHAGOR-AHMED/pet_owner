import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

import er404 from '../pages/common/404.vue'
import Dashboard from '../pages/dashboard.vue'
import MyMarker from '../pages/marker/index.vue'
import FindPet from '../pages/find_pet/index.vue'
import FindFlyer from '../pages/find_pet/flyer.vue'
import LostFlyer from '../pages/lost_pet/flyer.vue'
import LostPet from '../pages/lost_pet/index.vue'
import PetPassport from '../pages/pet_passport/index.vue'
import PetConcierge from '../pages/pet_concierge/index.vue'

const router = new VueRouter({
    mode: 'history',
    routes : [

        {
            path: '/certificate',
            component: Dashboard,
            name: 'Dashboard',
            meta:{
                title: 'Pet Certificate',
            },
        },
        
        {
            path: '/Marker',
            component: MyMarker,
            name: 'MyMarker',
            meta:{
                title: 'Marker',
            },
        },

        {
            path: '/find_pet',
            component: FindPet,
            name: 'FindPet',
            meta:{
                title: 'Find Pet',
            },
        },

        {
            path: '/find_pet_flyer/:id',
            component: FindFlyer,
            name: 'FindFlyer',
            meta:{
                title: 'Find Pet Flyer',
            },
        },

        {
            path: '/lost_pet_flyer/:id',
            component: LostFlyer,
            name: 'LostFlyer',
            meta:{
                title: 'Lost Pet Flyer',
            },
        },

        {
            path: '/lost_pet',
            component: LostPet,
            name: 'LostPet',
            meta:{
                title: 'Lost Pet',
            },
        },

        {
            path: '/petPassport',
            component: PetPassport,
            name: 'PetPassport',
            meta:{
                title: 'Pet Passport',
            },
        },

        {
            path: '/pet_concierge',
            component: PetConcierge,
            name: 'PetConcierge',
            meta:{
                title: 'Pet Concierge',
            },
        },

        {
            path: '/*',
            component: er404,
            name: 'er404',
            meta:{
                title: 'Room 404',
            },
        },

    ]
});


// Run brfore every route request
router.beforeEach( (to, from, next) => {
    // console.log(to, to.meta);

    let appName = 'Pet Care | ';
    let title = to.meta && to.meta.title ? to.meta.title : '';
    // set current title
    document.title =`${ appName } ${ title }`;

    next();
});


export default router;
