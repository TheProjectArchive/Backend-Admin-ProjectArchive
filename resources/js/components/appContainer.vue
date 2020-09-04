<template>
    <div id="app" class='container'>
        <Header/>
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    computed: {
        currentUser: {
            get() {
                return this.$store.state.currentUser.user;
            }
        }
    },
    components: {
        Header: () => import("./Header")
    },
    methods: {
        
    },
    created() {
        if(sessionStorage.hasOwnProperty("blog_token") ){
            axios.defaults.headers.common["Authorization"] = "Bearer " + sessionStorage.getItem("blog_token");
        this.$store.dispatch('currentUser/getUser');
        }else{
            window.location.replace("/login");
        }      
    }
}
</script>