<template>
  <div class="AdminUser">
   <el-row>
      <el-col :span="24">
        <el-breadcrumb separator-class="el-icon-arrow-right">
          <el-breadcrumb-item :to="{ path: '/Admin' }">
          {{prop.title}}
          </el-breadcrumb-item>
          <el-breadcrumb-item>新增成员</el-breadcrumb-item>
        </el-breadcrumb>
      </el-col>
    </el-row>
    
    <section>
         <el-row>
                 <router-link to='/Admin/AdminUser'><el-button type="success" >返回成员列表</el-button></router-link>
          </el-row>

<el-row :gutter="20">
  <el-col :span="12">
<el-form ref="form" :model="form"  status-icon label-width="80px">
  <el-form-item label="用户昵称" :rules="[{ required: true,message: '请输入用户昵称', trigger: 'blur' }]"  prop="username" >
    <el-input v-model="form.username"></el-input>
  </el-form-item>
  <el-form-item label="电子邮箱"  :rules="[
      { required: true, message: '请输入邮箱地址', trigger: 'blur' },
      { type: 'email', message: '请输入正确的邮箱地址', trigger: ['blur', 'change'] }
    ]" prop="email">
    <el-input v-model="form.email"></el-input>
  </el-form-item>

    <el-form-item label="初始密码" :rules="[{ required: true,message: '请输入初始密码', trigger: 'blur'} ]"    prop="password">
    <el-input type="password" v-model="form.password" autocomplete="off"></el-input>
  </el-form-item>
  <el-form-item label="确认密码" :rules="[{ required: true,message:'请输入确认密码', trigger: 'blur' }]"  prop="checkPass">
    <el-input type="password" v-model="form.checkPass" autocomplete="off"></el-input>
  </el-form-item>
  <el-form-item label="联系电话">
    <el-input v-model="form.tel"></el-input>
  </el-form-item>
  <el-form-item label="选择帮派">
    <el-select v-model="form.faction" placeholder="请选择选择您要加入的帮派">
      <el-option v-for="(val,index) in tableData" :label="val.className" :value="val.className"></el-option>
    </el-select>
  </el-form-item>
  <el-form-item :label="form.status==true?'状态正常':'状态异常'">
      <el-switch
        v-model="form.status"
        inactive-color="red">
      </el-switch>
  </el-form-item>
  <el-form-item label="成员级别">
    <el-select v-model="form.level" placeholder="选择用户级别">
      <el-option label="杂役弟子" value="0"></el-option>
      <el-option label="外门弟子" value="1"></el-option>
      <el-option label="内门弟子" value="2"></el-option>
      <el-option label="核心弟子" value="3"></el-option>
      <el-option label="真传弟子" value="4"></el-option>
      <el-option label="外门长老" value="5"></el-option>
      <el-option label="内门长老" value="6"></el-option>
      <el-option label="掌门人" value="7"></el-option>
    </el-select>
  </el-form-item>
  <el-form-item label="用户备注">
    <el-input type="textarea" v-model="form.desc"></el-input>
  </el-form-item>
  <el-form-item>
    <el-button type="primary" @click="submitForm('form')">立即创建</el-button>
    <el-button>取消</el-button>
  </el-form-item>
</el-form>
    </el-col>
</el-row>


    </section>
  </div>
</template>

<script>
import jsonp from 'jsonp'
export default {
  name: 'AdminUser',
  props:{
    prop:Object
  },
    data() {
      return {
        form: {
          send:true,
          username: '1111',
          tel:"111",
          email:"yyx219@qq.com",
          password:"111",
          checkPass:"111",
          faction: '',
          status: true,
          level: "",
          remark: ''
        },
        tableData:[],
      }
    },
    methods: {
   
      submitForm(formName) {

        this.$refs[formName].validate((valid) => {
          if (valid) {
            
            let formData = new FormData(this.$refs);

            for (const key in this.form) {
              if (this.form.hasOwnProperty(key)) {
                const element = this.form[key];
                // console.log(key,element)
                formData.append(key,element)
                
              }
            }



        
            this.axios.post('http://t.hzbiz.net/static/api/userAdd.php',formData)
            .then(
              res =>{
                console.log(res)
              }
            )
            .catch(
              err =>{
                console.log(err+"2")
              }
            )
          } else {
            console.log('error submit!!');
            return false;
          }
        });
      },
      resetForm(formName) {
        this.$refs[formName].resetFields();
      },
      getList: function() {
            jsonp("http://t.hzbiz.net/static/api/getFaction.php", null, (err, data) => {
                // console.log(data.message);
                this.tableData = data.message;
            })
        }
    },
    created(){
       this.getList()
    }
    }

</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
section{
  padding:0 15px;
}
</style>
