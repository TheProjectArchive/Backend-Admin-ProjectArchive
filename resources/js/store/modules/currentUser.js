import Axios from 'axios';

const state = {
    user: {}
};
const getters = {};
const actions = {
    getUser({commit}){
        axios
        .get("http://admin.theprojectarchive.com/api/user/current")
        .then(response => {
            commit('setUser', response.data);
        });
    },

    loginUser({}, user) {
        Axios
        .post("http://admin.theprojectarchive.com/api/user/login", {
            username: user.username,
            password: user.password,
        })
        .then(response => {
            if(response.data.access_token){
                //save them
                sessionStorage.setItem("blog_token",response.data.access_token)
            }

            window.location.replace("/home")
        })
        .catch(error => {
            if(error.response){
                alert(error.response.data.message);
            }
        });
    },

    logoutUser() {
        sessionStorage.removeItem("blog_token");
        window.location.replace("/");
    }
};
const mutations = {
    setUser( state,data ) {
        state.user = data;
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations,
}