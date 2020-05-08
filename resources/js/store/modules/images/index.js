const state = {
    images: null,
    image: null,
    profile_id: null,
};

const getters = {
    IMAGES: state => {
        return state.images;
    },
    IMAGES_PROFILE: state => {
        return state.profile_id;
    },
    IMAGE: state => {
        return state.image;
    },
};

const mutations = {
    SET_IMAGES: (state, payload) => {
        state.images = payload;
    },
    SET_IMAGE: (state, payload) => {
        state.image = payload;
    },
    SET_PROFILE_ID: (state, payload) => {
        state.profile_id = payload;
    },
};

const actions = {
    SAVE_IMAGE: async (context, payload) => {
        let {data} = await window.axios.post('/api/images', payload);
        context.commit('SET_IMAGE', data);
        context.dispatch('RELOAD_IMAGES');
    },
    LOAD_IMAGES: async (context, payload) => {
        context.commit('SET_PROFILE_ID', payload);
        context.dispatch('RELOAD_IMAGES');

    },
    RELOAD_IMAGES: async (context) => {
        let id = context.getters.IMAGES_PROFILE;
        let url = '/api/images';
        if (id > 0) {
            url = '/api/profile/' + id + '/images';
        }

        let {data} = await window.axios.get(url);
        context.commit('SET_IMAGES', data);
    },
    REMOVE_IMAGE: async (context, payload) => {
        let {data} = await window.axios.delete(`/api/images/${payload}`);
        context.dispatch('RELOAD_IMAGES');
    }

};

export default {
    state,
    getters,
    mutations,
    actions,
};
