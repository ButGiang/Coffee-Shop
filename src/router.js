import { createRouter, createWebHistory } from 'vue-router'

import authLayout from './components/Auth/layout.vue'
import signIn from './components/Auth/signIn.vue'
import signUp from './components/Auth/signUp.vue'

import mainLayout from './components/Main/layout.vue'
import home from './components/Main/home.vue'
import product from './components/Main/Product/product.vue'
import category from './components/Main/Product/category.vue'


const routes = [
    {
        path: '/',
        component: authLayout,
        children: [
            {
                path: '',
                component: signIn
            },
            {
                path: '/Register',
                component: signUp
            }
        ]
    },
    {
        path: '/Home',
        component: mainLayout,
        children: [
            {
                path: '',
                component: home
            }
        ],
        meta: { requiresAuth: true }
    },
    {
        path: '/Product',
        component: mainLayout,
        children: [
            {
                path: '',
                component: product
            }
        ],
        meta: { requiresAuth: true }
    },
    {
        path: '/Category',
        component: mainLayout,
        children: [
            {
                path: '',
                component: category
            }
        ],
        meta: { requiresAuth: true }
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes: routes
})

router.beforeEach((to, from, next) => {
    const authToken = localStorage.getItem('authToken');
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!authToken) {
            next('/');
        } else {
            next();
        }
    } else {
        next();
    }
});

export default router