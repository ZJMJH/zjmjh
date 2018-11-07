<template>
  <div class="AdminModify">
      <el-table
    :data="tableData"
    border
    style="width:1100px">
    <el-table-column
      fixed
      prop="classAddTime"
      label="创建日期"
      width="200">
    </el-table-column>
    <el-table-column
      prop="className"
      label="门派名称"
      width="120">
    </el-table-column>
    <el-table-column
      prop="isClassOpen"
      label="是否开放"
      width="120">
    </el-table-column>
    <el-table-column
      prop="classNature"
      label="门派性质"
      width="120">
    </el-table-column>
    <el-table-column
      prop="classInfo"
      label="门派介绍"
      width="420">
    </el-table-column>
    <el-table-column
      fixed="right"
      label="操作"
      width="100">
      <template slot-scope="scope">
        <el-button @click="handleClick(scope.row)" type="text" size="small">查看</el-button>
        <el-button type="text" size="small">编辑</el-button>
      </template>
    </el-table-column>
  </el-table>
  </div>
</template>

<script>
import jsonp from 'jsonp'
export default {
  name: 'AdminModify',
  methods:{
    handleClick(row) {
        console.log(row);
      },
    getList: function () {
    jsonp("http://t.hzbiz.net/static/api/getFaction.php", null, (err, data) => {
        console.log(data.message);
        this.tableData=data.message;

    })
    }
  },
  created() {
    this.getList()
  },
    data() {
      return {
         tableData:[] 
      }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.AdminModify .el-main{
    padding: 30px;
}
</style>
