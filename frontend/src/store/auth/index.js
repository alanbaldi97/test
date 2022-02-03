

const state = {
    user:null,
    permissions:[]
}

const mutations = {
    setUser(state, value){
        state.user = value;
    },
    setPermissions(state, value){
        state.permissions = value;
    }
    
}

const actions = {

    setUser({commit}, user){
        commit('setUser',user);
        commit('setPermissions',user.permissions);
    },
    setPermissions({commit}, permissions){
        commit('setPermissions',permissions);
    }
    
}

const getters = {
    getUser(state ){
        return state.user;
    },
    getRoles(state){
        const roles = state.user.roles.map( item => item.name );
        return roles;
    },

    permissions(state ){
        return state.permissions.map( item => item.name );
    }
}


export default {
    namespaced: true,
    getters,
    mutations,
    actions,
    state,
};
  


