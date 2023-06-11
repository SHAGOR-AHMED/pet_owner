import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);

import Dashboard from '../pages/dashboard.vue'
import LoginForm from './../../components/Login.vue'
import ResetPassword from './../../components/ResetPassword.vue'
import er404 from '../pages/common/404.vue'

import UserIndex from '../pages/user/index.vue'
import RoleIndex from '../pages/role/index.vue'
import UserTrash from '../pages/user/trash.vue'

import CertificateIndex from '../pages/certificate/index.vue'
import MarkerIndex from '../pages/marker/index.vue'
import PetConciergeIndex from '../pages/pet_concierge/index.vue'

const router = new VueRouter({
    mode: 'history',
    routes : [

        {
            path: '/admin/index',
            component: Dashboard,
            name: 'Dashboard',
            meta:{
                title: 'Admin Dashboard',
            },
        },

        {
            path: '/',
            component: LoginForm,
            name: 'LoginForm',
            meta:{
                title: 'Login',
            },
        },

        {
            path: '/admin-login',
            component: LoginForm,
            name: 'LoginForm',
            meta:{
                title: 'Login',
            },
        },

        {
            path: '/reset_confirm/*',
            component: ResetPassword,
            name: 'ResetPassword',
            meta:{
                title: 'Reset Password',
            },
        },

        {
            path: '/admin/user',
            component: UserIndex,
            name: 'UserIndex',
            meta:{
                title: 'User Dashboard',
            },
        },

        {
            path: '/admin/role',
            component: RoleIndex,
            name: 'RoleIndex',
            meta:{
                title: 'Role',
            },
        },

        {
            path: '/admin/user-trash',
            component: UserTrash,
            name: 'UserTrash',
            meta:{
                title: 'User Trash',
            },
        },

        {
            path: '/admin/pet-certificate',
            component: CertificateIndex,
            name: 'CertificateIndex',
            meta:{
                title: 'Pet Certificate',
            },
        },
        
        {
            path: '/admin/marker',
            component: MarkerIndex,
            name: 'MarkerIndex',
            meta:{
                title: 'Marker',
            },
        },

        {
            path: '/admin/pet_concierge',
            component: PetConciergeIndex,
            name: 'PetConciergeIndex',
            meta:{
                title: 'Pet Concierge',
            },
        },
        

        {
            path: '/admin/*',
            component: er404,
            name: 'er404',
            meta:{
                title: 'Super Admin 404',
            },
        },

    ]
});


// Run brfore every route request
router.beforeEach( (to, from, next) => {
    // console.log(to, to.meta);

    let appName = 'Pet Owner | ';
    let title = to.meta && to.meta.title ? to.meta.title : '';
    // set current title
    document.title =`${ appName } ${ title }`;

    next();
});


export default router;
