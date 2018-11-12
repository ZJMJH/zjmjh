<template>
  <div class="AdminUser">
   <el-row>
      <el-col :span="24">
        <el-breadcrumb separator-class="el-icon-arrow-right">
          <el-breadcrumb-item :to="{ path: '/Admin' }">
          {{prop.title}}
          </el-breadcrumb-item>
          <el-breadcrumb-item>成员列表</el-breadcrumb-item>
        </el-breadcrumb>
      </el-col>
    </el-row>
    
    <section>
         <el-row>
                 <router-link to='/Admin/AdminUserAdd'><el-button type="success" >添加普通帮众</el-button></router-link>
          </el-row>

    </section>
  </div>
</template>

<script>
export default {
  name: 'AdminUser',
  props:{
    prop:Object
  },
  data(){
    return {
      msg:"AdminUser"
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
section{
  padding:0 15px;
}
</style>
