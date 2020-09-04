<template>
    <div class="container">
        <router-link :to="'/about-desc/'">ABOUT DESC</router-link>
        <router-link :to="'/content-list/'">CONTENT</router-link>
        <router-link :to="'/category-list/'">CATEGORY</router-link>
    </div>
</template>

<style lang="css" scoped>
    .container{
        position: relative;     
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 80vh;
        top:0;
    }
    a{
        text-decoration: none;
        color: black;
        margin-bottom: 20px;
        font-size: 28px;
        font-weight: bold;
        text-transform: uppercase;
    }
</style>