import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

import Home from '../pages/home'
import CategoryList from '../pages/category/index'
import CreateCategory from '../pages/category/create'
import EditCategory from '../pages/category/edit'

import ProductList from '../pages/product/index'
import CreateProduct from '../pages/product/create'
import EditProduct from '../pages/product/edit'

const routes = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            component: Home,
            name: 'home'
        },
        {
            path: '/categories',
            component: CategoryList,
            name: 'category-list'
        },
        {
            path: '/categories/create',
            component: CreateCategory,
            name: 'category-create'
        },
        {
            path: '/categories/:slug/edit',
            component: EditCategory,
            name: 'category-edit'
        }
        ,
        {
            path: '/products',
            component: ProductList,
            name: 'product-list'
        },
        {
            path: '/products/create',
            component: CreateProduct,
            name: 'product-create'
        },
        {
            path: '/products/:slug/edit',
            component: EditProduct,
            name: 'product-edit'
        }
    ]
});

export default routes;
