require('../bootstrap');



// import dependecies tambahan
import Vue from 'vue';
import VueRouter from 'vue-router';
import VueAxios from 'vue-axios';
import Axios from 'axios';

Vue.use(VueRouter,VueAxios,Axios);

// import file Contact
import Create from '../components/Create.vue';
import Read_Contact from '../components/Read_Contact.vue';
import Update_Contact from '../components/Update_Contact.vue';
// import file Content
import Create_Content from '../components/Create_Content.vue';
import Read_Content from '../components/Read_Content.vue';
import Update_Content from '../components/Update_Content.vue';
// import file Categories
import Create_Category from '../components/Create_Category.vue';
import Read_Category from '../components/Read_Category.vue';
import Update_Category from '../components/Update_Category.vue';
import Home from '../components/Home.vue';
//import file About Desc
import Read_AboutDesc from '../components/Read_AboutDesc.vue'
import Update_AboutDesc from '../components/Update_AboutDesc.vue'


// membuat router
const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'readContact',
        path: '/contact-list',
        component: Read_Contact
    },
    {
        name: 'createContact',
        path: '/create',
        component: Create
    },
    {
        name: 'updateContact',
        path: '/detail-contact/:id',
        component: Update_Contact
    },
    {
        name: 'readContent',
        path: '/content-list',
        component: Read_Content
    },
    {
        name: 'createContent',
        path: '/create-content',
        component: Create_Content
    },
    {
        name: 'updateContent',
        path: '/detail-content/:id',
        component: Update_Content
    },
    {
        name: 'readCategory',
        path: '/category-list',
        component: Read_Category
    },
    {
        name: 'createCategory',
        path: '/create-category',
        component: Create_Category
    },
    {
        name: 'updateCategory',
        path: '/detail-category/:id',
        component: Update_Category
    },
    {
        name: 'readAboutDesc',
        path: '/about-desc',
        component: Read_AboutDesc
    },
    {
        name: 'updateAboutDesc',
        path: '/detail-aboutdesc/:id',
        component: Update_AboutDesc
    },
]

export default new VueRouter({
    routes 
});