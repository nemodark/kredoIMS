import VueRouter from 'vue-router';

import Home from './components/Home.vue';
import LoginPage from './components/Login.vue';

//---- Admin Pages ----
import Admin from './components/admin/Index.vue';

// Users
import AdminUserComponent from './components/admin/users/UserComponent.vue';
import AdminAddUserComponent from './components/admin/users/AddUserComponent.vue';
import AdminEditUserComponent from './components/admin/users/EditUserComponent.vue';

//Categories
import AdminCategoryComponent from './components/admin/categories/CategoryComponent.vue';
//Brands
import AdminBrandComponent from './components/admin/brands/BrandComponent.vue';
//!---- Admin Pages ----!

const routes = [
    {
        path: '/',
        name: 'home',
        component: Home,
        meta: {
            auth: true
        },
    },
    {
        name: 'login',
        path: '/login',
        component: LoginPage,
        meta: {
            auth: false
        },
    },
    {
        path: '/admin',
        name: 'admin',
        component: Admin,
        meta: {
            auth: {roles: 'admin', redirect: {name: 'login'}, forbiddenRedirect: '/403'}
            },
        children: [
            {

                name: 'admin.users',
                path: '/admin/users',
                components: 
                {
                content: AdminUserComponent
                }
            },
            {
                name: 'admin.createUser',
                path: '/admin/users/create',  
                components: 
                {
                content: AdminAddUserComponent
                }
            },
            {
                name: 'admin.editUser',
                path: '/admin/users/:id/edit',
                components: 
                {
                content: AdminEditUserComponent
                }
            },
            {
                name: 'admin.category',
                path: '/admin/categories',
                components: 
                {
                content: AdminCategoryComponent
                }
            },
            {
                name: 'admin.brand',
                path: '/admin/brands',
                components:
                {
                    content: AdminBrandComponent
                }
            }
        ]
    },
    
];

const router = new VueRouter({
    history: true,
    mode: 'history',
    routes,
})

export default router;