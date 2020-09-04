<template>
    <div class="header">
        <a href="/home" style="color:white;text-decoration: none;">HOME</a><br>
        <a @click="logout" style="color:white;text-decoration: none;">Logout</a>
    </div>
</template>

<style lang="css" scoped>
    .header{
        position: relative;
          top: 0;
          width: 100%;
          height: 60px;
          left: 0;
          background-color: black;
    }
    a{
        text-transform: uppercase;
        text-decoration: none;
        font-weight: bold;
        cursor: pointer;
    }
</style>

<script>
export default {
    methods: {
        logout(){
            this.$store.dispatch('currentUser/logoutUser');
        }
    }
}
</script>