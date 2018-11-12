<template>
  <div class="AdminIndex">
    <el-row>
      <el-col :span="24">
    <el-breadcrumb separator-class="el-icon-arrow-right">
      <el-breadcrumb-item :to="{ path: '/Admin/AdminIndex' }">{{prop.title}}</el-breadcrumb-item>
      <el-breadcrumb-item>首页</el-breadcrumb-item>
    </el-breadcrumb>
      </el-col>
    </el-row>
  <section>
    <el-row :gutter="20">
      <el-col :span="16">
        <div class="grid-content bg-purple">
          <el-card class="box-card">
            <div slot="header" class="clearfix">
              <span>最新发布的信息</span>
            </div>
            <div v-for="o in 4" :key="o" class="text item">
              {{'列表内容 ' + o }}
            </div>
          </el-card>
        </div>
      </el-col>
      <el-col :span="8">
        <div class="grid-content bg-purple">
          <el-card class="box-card">
            <div slot="header" class="clearfix">
              <span>当前用户</span>
            </div>
            <div class="text item">
               <el-row :gutter="10">
                   <el-col :span="8">
                      <div class="head" >
                        <img :src="head" alt="">
                      </div>
                    </el-col>
                      <el-col :span="16">
                           <ul class="userinfo">
                              <li><strong>昵称:</strong>南笙</li>
                              <li><strong>性别:</strong>女</li>
                              <li><strong>身份:</strong>堡主</li>
                              <li><strong>组织:</strong>魔仙堡</li>
                              <li><strong>巴拉:</strong>13012341234</li>
                              <li><strong>最近访问:</strong>2018-10-31 11:09:44</li>
                           </ul>

                        </el-col> 
               </el-row>
              

            </div>
          </el-card>
        </div>
      </el-col>
    </el-row>
</section>
  </div>
</template>

<script>
export default {
  name: 'AdminIndex',
  props:{
     prop:Object
  },
  data(){
    return {
      msg:"AdminIndex",
      head:require("../../assets/head.png"),
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
section{
  padding:0px 20px 20px 20px;
}
.el-row {
    margin-bottom: 20px;
    &:last-child {
      margin-bottom: 0;
    }
  }
  .el-col {
    border-radius: 4px;
  }
  .bg-purple-dark {
    background: #99a9bf;
  }
  .bg-purple {
    background: #d3dce6;
  }
  .bg-purple-light {
    background: #e5e9f2;
  }
  .grid-content {
    border-radius: 4px;
    min-height: 36px;
  }
  .row-bg {
    padding: 10px 0;
    background-color: #f9fafc;
  }
  .head{
    border-radius: 5px;
    border:1px solid #ddd;
    width:100%;
    height:150px;
    display: flex;
    justify-content: center;
    flex-flow: column;
    box-shadow: 2px 2px 2px #eee
  }
  .head img{
    width:99%;

  }
  .userinfo {
     margin-left:15px;
  }
  .userinfo li{
     line-height:25px;
  }
  .userinfo li strong{
     margin-right:15px;
  }
</style>
