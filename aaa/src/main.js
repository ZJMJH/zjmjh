import Vue from 'vue'
import App from './App.vue'
import VueRouter from 'vue-router'
import router from './router.js'
import axios from 'axios'
import VueAxios from 'vue-axios'
import ElementUI from 'element-ui';
import 'element-ui/lib/theme-chalk/index.css';

// Vue.prototype.$axios = axios
Vue.use(ElementUI);
Vue.use(VueAxios,axios)
Vue.use(VueRouter)
Vue.config.productionTip = false


new Vue({
  el:"#app",
  router,
  render: h => h(App)
})
