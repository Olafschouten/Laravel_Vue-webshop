import Vue from "vue";
import VueRouter from "vue-router";
import Products from "../components/Products"
import Categories from "../components/Categories"
import Cart from "../components/Cart"
import Checkout from "../components/Checkout"
import Home from "../components/Home"
import Profile from "../components/Profile"
import Dashboard from "../components/Dashboard"
import Login from "../components/Login"
import SignUp from "../components/SignUp"
import Category from "../components/Category"
import Product from "../components/Product"
import store from "../store";

Vue.use(VueRouter)

const routes = [
    {
        path: "/home",
        component: Home,
        Name: 'Home'
    },
    {
        path: "/products",
        component: Products,
        Name: 'Products'
    },
    {
        path: "/product/:id",
        component: Product,
        Name: 'Product'
    },
    {
        path: "/categories",
        component: Categories,
        Name: 'Categories'
    },
    {
        path: "/category/:id",
        component: Category,
        Name: 'Category'
    },
    {
        path: "/cart",
        component: Cart,
        Name: 'Cart'
    },
    {
        path: "/checkout",
        component: Checkout,
        Name: 'Checkout',
        meta: {authOnly: true}
    },
    {
        path: "/",
        component: Home,
        Name: 'Home'
    },
    {
        path: "/profile",
        component: Profile,
        Name: 'Profile',
        meta: {authOnly: true}
    },
    {
        path: "/dashboard",
        component: Dashboard,
        Name: 'Dashboard',
        meta: {authOnly: true}
    },
    {
        path: "/login",
        component: Login,
        Name: 'Login',
        meta: {guestOnly: true}
    },
    {
        path: "/signup",
        component: SignUp,
        Name: 'SignUp',
        meta: {guestOnly: true}
    },
]

const router = new VueRouter({
    // mode: 'history',
    base: process.env.BASE_URL,
    routes
})

router.beforeEach((to, from, next) => {
    if (to.matched.some(record => record.meta.authOnly)) {
        if (!store.state.auth.authenticated) {
            next({
                path: "/login",
                query: {redirect: to.fullPath}
            });
        } else {
            next();
        }
    } else if (to.matched.some(record => record.meta.guestOnly)) {
        if (store.state.auth.authenticated) {
            next({
                path: "/dashboard",
                query: {redirect: to.fullPath}
            });
        } else {
            next();
        }
    } else {
        next();
    }
})

export default router;
