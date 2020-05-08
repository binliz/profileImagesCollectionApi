import Vue from 'vue';
import Vuex from 'vuex';

import profile from './modules/profile/index';
import images from './modules/images/index';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {},
    getters: {},
    mutations: {},
    actions: {},
    modules: {
        profile, images
    },
});
