const state = {
    profile_list: null,
    profile: null
};

const getters = {
    PROFILES: state => {
        return state.profile_list;
    },
    ONE_PROFILE: state => {
        return state.profile;
    },
};

const mutations = {
    SET_PROFILES: (state, payload) => {
        state.profile_list = payload;
    },
    SET_PROFILE: (state, payload) => {
        state.profile = payload;
    },
};

const actions = {
    GET_PROFILES: async (context, payload) => {
        let {data} = await window.axios.get('/api/profile');
        context.commit('SET_PROFILES', data);
    },
    GET_PROFILE: async (context, payload) => {
        context.commit('SET_PROFILE', null);
        let {data} = await window.axios.get('/api/profile/' + payload);
        context.commit('SET_PROFILE', data);
    },

    SAVE_PROFILE: async (context, payload) => {
        let {data} = await window.axios.post('/api/profile', payload);
        context.commit('SET_PROFILE', data);
    },
    UPDATE_PROFILE: async (context, payload) => {
        let {data} = await window.axios.put(`/api/profile/${payload.id}`, payload);
        context.commit('SET_PROFILE', data);
    },
    DELETE_PROFILE: async (context, payload) => {
        let {data} = await window.axios.delete(`/api/profile/${payload}`);
        context.dispatch('GET_PROFILES');
    },
};

export default {
    state,
    getters,
    mutations,
    actions,
};
