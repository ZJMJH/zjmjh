<template>
  <div class="Admin">
    <el-container>
      <el-header style="height:60px;">
         <router-link to='/Admin'><img :src="system.logo" class="logo" alt=""></router-link>
      </el-header>
      <el-container>
        <el-aside width="200px">
          <el-row class="tac">
              <el-col :span="24">
                <el-menu
                  default-active="2"
                  class="el-menu-vertical-demo"
                  background-color="#fbfbfb"
                  text-color="#888"
                  active-text-color="#000"
                  :router=true
                  :default-openeds='defaultOpeneds'
                  @open="handleOpen"
                  @close="handleClose">
                  <el-submenu v-for="(val,index) in navigation" :key="index" :index="''+(index+1)">
                    <template slot="title">
                      <i :class="val.icon"></i>
                      <span>{{val.title}}</span>
                    </template>
                      <el-menu-item v-for="(childrenValue,index) in val.children" :key="index" :index="childrenValue.path">{{childrenValue.title}}</el-menu-item>
                  </el-submenu>

 
                </el-menu>
              </el-col>
          </el-row>
        </el-aside>
        <el-main>
          <router-view :prop = 'system'></router-view>
        </el-main>
      </el-container>
    </el-container>
  </div>
</template>

<script>
export default {
  name: "Admin",
  data() {
    return {
      system: {
        logo: require("../../assets/logo.png"),
        title:"0718后台管理系统"
      },
      defaultOpeneds:['1'],
      navigation:[
         {id:1,title:"系统设置",path:"/Admin",parent_id:0,icon:"el-icon-setting",children:[
            {id:2,title:"网站基本设置",path:"/Admin/AdminSystem",parent_id:1}
         ]},
         {id:3,title:"门派管理",path:"/Admin/AdminUser",parent_id:0,icon:"el-icon-service",children:[
            {id:4,title:"掌门人管理",path:"/Admin/AdminRoot",parent_id:3},
            {id:5,title:"门派成员管理",path:"/Admin/AdminUser",parent_id:3},
            {id:9,title:"门派注册管理",path:"/Admin/AdminFaction",parent_id:3},
            {id:10,title:"门派管理列表",path:"/Admin/AdminFactionList",parent_id:3},
         ]},
         {id:6,title:"信息管理",path:"/Admin/AdminInfo",parent_id:0,icon:"el-icon-document",children:[
            {id:7,title:"信息列表",path:"/Admin/AdminInfo",parent_id:6},
            {id:8,title:"信息添加",path:"/Admin/AdminInfoAdd",parent_id:6}
         ]}
      ]
     
    };
  },
   methods: {
      handleOpen(key, keyPath) {
        console.log(key, keyPath);
        this.defaultOpeneds = keyPath
      },
      handleClose(key, keyPath) {
        console.log(key, keyPath);
      }
    }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style>
.Admin .el-header {
  background-image: -webkit-gradient(
    linear,
    left top,
    right top,
    from(#1278f6),
    to(#00b4aa)
  );
  background-image: -webkit-linear-gradient(left, #1278f6, #00b4aa);
  background-image: -moz-linear-gradient(left, #1278f6, #00b4aa);
  background-image: linear-gradient(to right, #1278f6, #00b4aa);
}

.Admin .el-header,
.el-footer {
  background-color: #b3c0d1;
  color: #333;
  text-align: left;
  height: 60px;
  padding: 0;
}
.Admin .logo {
  margin-top: 10px;
  margin-left: 15px;
  height: 35px;
}
.Admin .el-aside {
  background-color: #fbfbfb;
  color: #333;
  text-align: left;
  position: absolute;
  left: 0;
  bottom: 0;
  top: 60px;
}

.Admin .el-main {
  background-color: #f8f8f8;
  color: #333;
  text-align: left;
  position: absolute;
  right: 0;
  top: 60px;
  bottom: 0px;
  padding: 0;
  width: calc(100% - 200px);
}

.Admin body > .el-container {
  margin-bottom: 40px;
  position: relative;
}

.el-breadcrumb{
   background:#fff;
   box-shadow: 0 0 3px #eee;
   /* margin:-20px; */
   padding:15px 0 15px 20px;
}
.avatar-uploader .el-upload {
    border: 1px dashed #d9d9d9;
    border-radius: 6px;
    cursor: pointer;
    position: relative;
    overflow: hidden;
  }
  .avatar-uploader .el-upload:hover {
    border-color: #409EFF;
  }
  .avatar-uploader-icon {
    font-size: 28px;
    color: #8c939d;
    width: 178px;
    height: 178px;
    line-height: 178px;
    text-align: center;
  }
  .avatar {
    width: 178px;
    height: 178px;
    display: block;
  }
.el-form {
  border: 1px solid #ddd;
  box-shadow: 3px 3px 3px #eee;
  padding: 15px;
  margin: 25px;
  border-radius: 5px;
}

</style>
