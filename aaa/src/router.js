import Vue from 'vue'
import VueRouter from 'vue-router'
import HelloWorld from './components/HelloWorld.vue'
import Index from './components/Index.vue'
import Login from './components/Login.vue'
import Admin from './components/admin/Admin.vue'
import AdminIndex from './components/admin/AdminIndex.vue'
import AdminSystem from './components/admin/AdminSystem.vue'
import AdminRoot from './components/admin/AdminRoot.vue'
import AdminUser from './components/admin/AdminUser.vue'
import AdminFaction from './components/admin/AdminFaction.vue'
import AdminModify from './components/admin/AdminModify.vue'
Vue.use(VueRouter)

const routes = [
    {
        path:'/HelloWorld',
        name:'HelloWorld',
        component:HelloWorld,
        meta:{
            title:"测试页面"
        }
    },
    {
        path:'/',
        name:'Index',
        component:Index,
        meta:{
            title:"0718网站首页"
        }
    },
    {
        path:'/Login',
        name:'Login',
        component:Login,
        meta:{
            title:"0718后管理登陆页面"
        }
    },
    {
        path: '/Admin',
        component: Admin,
        redirect: () => {
            return { path: '/Admin/AdminIndex' };
        },
        meta:{
            title:"0718后台管理系统"
        },
        children: [
        {
            path: '/Admin/AdminIndex',
            component: AdminIndex,
            meta:{
                title:"登陆页说明"
            },
        },
        {
            path: '/Admin/AdminSystem',
            component: AdminSystem,
            meta:{
                title:"网站基本信息设置"
            },
        },
        {
            path: '/Admin/AdminRoot',
            component: AdminRoot,
            meta:{
                title:"掌门人管理"
            },
        },
        {
            path: '/Admin/AdminUser',
            component: AdminUser,
            meta:{
                title:"门派成员管理"
            },
        },
        {
            path: '/Admin/AdminFaction',
            component: AdminFaction,
            meta:{
                title:"门派注册管理"
            },
        },
        {
            path: '/Admin/AdminModify',
            component: AdminModify,
            meta:{
                title:"掌门人编辑"
            },
        }
        ]
    }
]
  

const router = new VueRouter({
    mode:'history',  
    routes:routes
})

router.beforeEach((to,from,next) =>{
    if(to.meta.title){
        document.title = to.meta.title
    }
    next()
})


export default router;