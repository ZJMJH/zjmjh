<template>
  <div class="Index">

       <h1   class="text-center" v-for="(i,key) in getArrData">
         <router-link :to='key'>{{i}}</router-link>
       </h1>

      <router-view></router-view>
  </div>
</template>

<script>
export default {
  name: 'Index',
  props:{
     getArrData:Object
  },
  data(){
    return {
      
    }
  }

}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style>
   
</style>
