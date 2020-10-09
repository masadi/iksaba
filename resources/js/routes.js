export default [
    { path: '/', component: require('./components/Welcome.vue').default },
    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/profile', component: require('./components/Profile.vue').default },
    { path: '/santri', component: require('./components/Santri.vue').default },
    { path: '/alumni', component: require('./components/Alumni.vue').default },
    //{ path: '/developer', component: require('./components/Developer.vue').default },
    { path: '/users', component: require('./components/Users.vue').default },
    //{ path: '/products', component: require('./components/product/Products.vue').default },
    //{ path: '/product/tag', component: require('./components/product/Tag.vue').default },
    //{ path: '/product/category', component: require('./components/product/Category.vue').default },
    { path: '*', component: require('./components/NotFound.vue').default }
];
