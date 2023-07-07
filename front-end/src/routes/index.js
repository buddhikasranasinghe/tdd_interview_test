import { createRouter, createWebHistory } from 'vue-router'

import SubscribeWebsite from '../views/SubscribeWebsite.vue'
import AddPost from '../views/AddPost.vue'

const routes = [
    {
        path: '/',
        name: 'Home',
        component: SubscribeWebsite
    },
    {
        path: '/add-post',
        name: 'AddPost',
        component: AddPost
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes
});
  
export default router;  
