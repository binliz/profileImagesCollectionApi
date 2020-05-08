import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter)

import AddProfileComponent from "./components/AddProfileComponent";
import ListProfileComponent from "./components/ListProfileComponent";

export const router = new VueRouter({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'List',
            component: ListProfileComponent
        },
        {
            path: '/add',
            name: 'Add',
            component: AddProfileComponent,
        },
        {
            path: '/add/:id',
            name: 'Edit',
            component: AddProfileComponent,
        },
    ],

});
