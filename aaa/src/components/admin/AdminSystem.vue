<template>
  <div class="AdminSystem">
   <el-row>
      <el-col :span="24">
        <el-breadcrumb separator-class="el-icon-arrow-right">
          <el-breadcrumb-item :to="{ path: '/Admin/AdminIndex' }">{{prop.title}}</el-breadcrumb-item>
          <el-breadcrumb-item>基本信息管理</el-breadcrumb-item>
        </el-breadcrumb>
      </el-col>
    </el-row>
   <el-row>
      <el-col :span="16">
          <el-form ref="form" :model="system" label-width="80px">
            <el-form-item label="网站标题">
              <el-input maxlength="100" v-model="system.title" placeholder="请输入网站标题，最多100个字"></el-input>
            </el-form-item>
            <el-form-item label="网站名称">
              <el-input maxlength="20"  v-model="system.name" ></el-input>
            </el-form-item>

            <el-form-item label="网站logo">

<el-upload
  class="upload-demo"
  action="https://jsonplaceholder.typicode.com/posts/"
  :on-preview="handlePreview"
  :on-remove="handleRemove"
  :before-remove="beforeRemove"
  multiple
  :limit="1"
  :on-exceed="handleExceed"
  :file-list="system.fileList">
  <el-button size="small" type="primary">LOGO上传</el-button>
  <div slot="tip" class="el-upload__tip">只能上传jpg/png文件，且不超过500kb</div>
</el-upload>
  </el-form-item>

            <el-form-item label="网站域名">
      <el-input placeholder="请输入内容" v-model="system.http">
        <template slot="prepend">Http://</template>
      </el-input>
  </el-input>
            </el-form-item>
         <el-form-item label="关键字" >
            <el-tag
              :key="index"
              v-for="(tag,index) in system.dynamicTags"
              closable
              :disable-transitions="false"
              @close="handleClose(tag)">
              {{tag}}
            </el-tag>
            <el-input
              :class="{'input-new-tag':true}"
              v-model="system.inputTagValue"
              size="small"
              @blur="handleInputConfirm"
              @focus="system.isActive = false"
              placeholder="+ New Tag"
            >
            </el-input>
         </el-form-item>

         <el-form-item label="网站描述">
          <el-input type="textarea" rows=4 v-model="system.description" placeholder="请输入内容">
          </el-input>
         </el-form-item>

         <el-form-item label="版权声明">
          <el-input type="textarea" rows=6 v-model="system.copyright" placeholder="请输入您的网站版权声明">
          </el-input>
         </el-form-item>
            <el-form-item>
              <el-button type="primary" @click="onSubmit">立即创建</el-button>
              <el-button>取消</el-button>
              <input type="hidden" v-model="system.id" placeholder="">
            </el-form-item>
          </el-form>
      </el-col>
   </el-row>
  </div>
</template>

<script>
export default {
  name: "AdminSystem",
  props: {
    prop: Object
  },
  data() {
    return {
      system: {
        id:1,
        title: "", //网站标题
        name: "", //网站名称
        fileList: [], // {name: '', url: ''} LOGO上传
        fileListName:"",
        fileListUrl:"",
        http: "", //网址
        dynamicTags: [],
        inputVisible: false,
        inputTagValue: "",   //临时中转站
        description:"",
        copyright:"",
        isActive:true
      }
    };
  },
  methods: {
    success(val) {
        this.$message({
          message: '恭喜你，'+val,
          type: 'success'
        });
      },
    error(val) {
        this.$message({
          message: '警告哦，'+val,
          type: 'warning'
        });
      },
    onSubmit() {
         
         let formData = new FormData();
         formData.append('id',this.system.id)
         formData.append('send',true)
         formData.append('title',this.system.title)
         formData.append('name',this.system.name)
         formData.append('fileListName',this.system.fileList[0].name)
         formData.append('fileListUrl',this.system.fileList[0].url)
         formData.append('http',this.system.http)
         formData.append('dynamicTags',this.system.dynamicTags)
         formData.append('description',this.system.description)
         formData.append('copyright',this.system.copyright)

         this.axios.post('http://t.hzbiz.net/static/api/system.php',formData)
         .then(res=>{
            console.log(res)
            let data = res.data
            if(data.vaild){
                this.success(data.message)
            }else{
                this.error(data.message)
            }
         })
         .catch(err=>{
            // console.log(err)
             this.error(err)
         })
  
    },
    handleAvatarSuccess(res, file) {
      this.imageUrl = URL.createObjectURL(file.raw);
    },
    handleRemove(file, fileList) {
      console.log(file, fileList);
    },
    handlePreview(file) {
      console.log(file);
    },
    handleExceed(files, fileList) {
      this.$message.warning(
        `当前限制选择 3 个文件，本次选择了 ${
          files.length
        } 个文件，共选择了 ${files.length + fileList.length} 个文件`
      );
    },
    beforeRemove(file, fileList) {
      return this.$confirm(`确定移除 ${file.name}？`);
    },
    handleClose(tag) {
      this.system.dynamicTags.splice(this.system.dynamicTags.indexOf(tag), 1);
    },
    handleInputConfirm() {
      let inputTagValue = this.system.inputTagValue;
      if (inputTagValue) {
        this.system.dynamicTags.push(inputTagValue);
      }
       this.system.inputVisible = false;
       this.system.inputTagValue = "";
    },
    getSystem(id){
        let _this = this;
        this.axios.get('http://t.hzbiz.net/static/api/getsystem.php?id='+id)
        .then(function(res){
             let data = res.data.message[0];
             _this.system = data;
            _this.system.fileList=[{name:data.fileListName,url:data.fileListUrl}]
            _this.system.dynamicTags=data.dynamicTags.split(',')
        })
        .catch(function(err){
             console.log(err)
        })
    }
  },
  created(){
     this.getSystem(this.system.id)
  }
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

.el-tag + .el-tag {
  margin-left: 10px;
}
.button-new-tag {
  margin-left: 10px;
  height: 32px;
  line-height: 30px;
  padding-top: 0;
  padding-bottom: 0;
}
.input-new-tag {
  width: 90px;
  margin-left: 10px;
  vertical-align: bottom;
}.el-select .el-input {
    width: 130px;
  }
  .input-with-select .el-input-group__prepend {
    background-color: #fff;
  }

</style>
