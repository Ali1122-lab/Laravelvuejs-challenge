import { createWebHistory, createRouter } from 'vue-router';
import home from './pages/home.vue';
import login from './pages/login.vue';
import register from './pages/register.vue';
import dashboard from './pages/dashboard.vue';

const routes = [

    {
        path: '/',
        name: 'home',
        component: home

    },

    {
        path: '/login',
        name: 'login',
        component: login,
        meta: { requirsAuth: false }

    },

    {
        path: '/register',
        name: 'register',
        component: register,
        meta: { requirsAuth: false }

    },

    {
        path: '/dashboard',
        name: 'dashboard',
        component: dashboard,
        meta: { requirsAuth: true }


    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
});
router.beforeEach((to, from, next) => {
    if (to.meta.requirsAuth && !localStorage.getItem('token')) {
        next({
            path: 'login',
            replace: true
        })

    } else {
        next()
    }

})


export default router;

