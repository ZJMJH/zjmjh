<template>
  <div class="Adminfaction">
   <el-row>
      <el-col :span="24">
        <el-breadcrumb separator-class="el-icon-arrow-right">
          <el-breadcrumb-item :to="{ path: '/Admin' }">
          {{prop.title}}
          </el-breadcrumb-item>
          <el-breadcrumb-item>门派注册管理</el-breadcrumb-item>
        </el-breadcrumb>
      </el-col>
    </el-row>

    <section>
      <el-row>
          <el-col :span="16">
            <el-row type="flex" class="row-bg" justify="space-around">
              <el-col :span="24">
                <el-form :model="faction" :rules="rules" ref="faction" label-width="100px" class="demo-ruleForm">
                  <el-form-item label="门派名称" prop="className">
                    <el-input v-model="faction.className"></el-input>
                  </el-form-item>
                  <el-form-item label="掌门设置" prop="classUserID">
                    <el-select v-model="faction.classUserID" placeholder="请选择门派负责人">
                      <el-option label="王昕" value="1"></el-option>
                      <el-option label="王雪晶" value="2"></el-option>
                      <el-option label="罗学成" value="3"></el-option>
                      <el-option label="刑黎" value="4"></el-option>
                      <el-option label="张堃" value="5"></el-option>
                    </el-select>
                  </el-form-item>
                  <el-form-item label="创建时间" prop="classAddTime" required>
                    <el-col :span="11">
                      <el-date-picker
                        v-model="faction.classAddTime"
                        type="datetime"
                        placeholder="选择日期时间"
                        align="right"
                        :picker-options="pickerOptions1"
                        value-format="yyyy-MM-dd HH:mm:ss">
                      </el-date-picker>
                    </el-col>
                  </el-form-item>
                  <el-form-item label="是否开放" prop="isClassOpen">
                    <el-switch v-model="faction.isClassOpen"></el-switch>
                  </el-form-item>
                  <el-form-item label="门派性质" prop="classNature">
                    <el-radio-group v-model="faction.classNature">
                      <el-radio label="魔教" value="1" name="type"></el-radio>
                      <el-radio label="正教" value="2"  name="type"></el-radio>
                      <el-radio label="六扇门" value="3" name="type"></el-radio>
                      <el-radio label="锦衣卫" value="4" name="type"></el-radio>
                      <el-radio label="东厂" value="5" name="type"></el-radio>
                    </el-radio-group>
                  </el-form-item>
                  <el-form-item label="门派介绍" prop="classInfo">
                    <el-input type="textarea" :rows=6 v-model="faction.classInfo"></el-input>
                  </el-form-item>
                  <el-form-item>
                    <el-button type="primary" @click="submitForm('faction')">创建门派</el-button>
                    <el-button @click="resetForm('faction')">重置</el-button>
                  </el-form-item>
                </el-form>
              </el-col>
            </el-row>
          </el-col>
          </el-row>
    </section>

  </div>
</template>

<script>
export default {
  name: 'Adminfaction',
  props:{
    prop:Object
  },
  data(){
    return {
        faction: {
          className: '',
          classUserID: "",
          classAddTime: '',
          isClassOpen: true,
          classNature: "",
          classInfo: ''
        },
        pickerOptions1: {
          shortcuts: [{
            text: '今天',
            onClick(picker) {
              picker.$emit('pick', new Date());
            }
          }, {
            text: '昨天',
            onClick(picker) {
              const date = new Date();
              date.setTime(date.getTime() - 3600 * 1000 * 24);
              picker.$emit('pick', date);
            }
          }, {
            text: '一周前',
            onClick(picker) {
              const date = new Date();
              date.setTime(date.getTime() - 3600 * 1000 * 24 * 7);
              picker.$emit('pick', date);
            }
          }]
        },
        rules: {
          className: [
            { required: true, message: '请输入注册门派的名称', trigger: 'blur' },
            { min: 3, max: 15, message: '门派名称 长度在 3 到 15 个字符', trigger: 'blur' }
          ],
          classUserID: [
            { required: true, message: '请选择门派掌门人', trigger: 'change' }
          ],
          classAddTime: [
            { type: 'string', required: true, message: '请选择日期', trigger: 'change' }
          ],
          classNature: [
            {required: true, message: '请选择门派性质', trigger: 'change' }
          ],
          classInfo: [
            { required: true, message: '请输入门派介绍', trigger: 'blur' }
          ]
        }
      };
  },
  methods:{
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
     submitForm(formName) {
        this.$refs[formName].validate((valid) => {
          if (valid) {
             
                let formData = new FormData();
                formData.append('send',true)
                formData.append('className',this.faction.className)
                formData.append('classUserID',this.faction.classUserID)
                formData.append('classAddTime',this.faction.classAddTime)
                formData.append('isClassOpen',this.faction.isClassOpen)
                formData.append('classNature',this.faction.classNature)
                formData.append('classInfo',this.faction.classInfo)

                this.axios.post('http://t.hzbiz.net/static/api/FactionAdd.php',formData)
                .then((res)=>{
                      let data = res.data
                      if(data.vaild){
                          this.success(data.message)
                      }else{
                          this.error(data.message)
                      }
                })
                .catch(err=>{
                  console.log(err)
                })


          } else {
            console.log('error submit!!');
            return false;
          }
        });
      },
      resetForm(formName) {
        this.$refs[formName].resetFields();
      }
  },
  created(){
 
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style>
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
</style>


