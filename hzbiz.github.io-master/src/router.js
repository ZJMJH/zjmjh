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
import AdminUserAdd from './components/admin/AdminUserAdd.vue'
import AdminUserEdit from './components/admin/AdminUserEdit.vue'
import AdminFaction from './components/admin/AdminFaction.vue'
import AdminFactionList from './components/admin/AdminFactionList.vue'
import AdminFactionEdit from './components/admin/AdminFactionEdit.vue'





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
                title:"门派成员列表"
            },
        },
        {
            path: '/Admin/AdminUserAdd',
            component: AdminUserAdd,
            meta:{
                title:"注册会员"
            },
        },
        {
            path: '/Admin/AdminUserEdit/:id',
            component: AdminUserEdit,
            meta:{
                title:"编辑会员"
            },
        },
        {
            path: '/Admin/AdminFaction',
            component: AdminFaction,
            meta:{
                title:"门派注册"
            },
        },
        {
            path: '/Admin/AdminFactionEdit/:id',
            component: AdminFactionEdit,
            meta:{
                title:"门派信息编辑"
            },
        },
        {
            path: '/Admin/AdminFactionList',
            component: AdminFactionList,
            meta:{
                title:"门派注册管理"
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