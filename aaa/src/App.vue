<template>
  <div id="app">
      <router-view :getArrData='arrData'></router-view>
  </div>
</template>

<script>
export default {
  name: 'app',
  data(){
     return {
        arrData:{
          Admin:"0718后台管理登陆页",
          Login:"登陆"
        }
     }
  },
  created(){
    // toFixed()
  }
}
</script>

<style>
  body{
     padding:0;
     margin:0;
     font-size: 13px;
     color:#333
  }
  ul,ol{
    padding:0;
    margin:0;
    list-style: none
  }
  #app {

  }
</style>
