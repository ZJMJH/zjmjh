<template>
    <div class="AdminFactionList">



        <el-row>
            <el-col :span="24">
                <el-breadcrumb separator-class="el-icon-arrow-right">
                    <el-breadcrumb-item :to="{ path: '/Admin/AdminIndex' }">{{prop.title}}</el-breadcrumb-item>
                    <el-breadcrumb-item>首页</el-breadcrumb-item>
                </el-breadcrumb>
            </el-col>
        </el-row>
        <section>
            <el-table :data="tableData" border>
                <el-table-column prop="id" label="编号" width="50">
                </el-table-column>
                <el-table-column prop="className" label="门派名称">
                </el-table-column>
                <el-table-column prop="isClassOpen" label="是否开放">
                </el-table-column>
                <el-table-column prop="classNature" label="门派性质">
                </el-table-column>
                <el-table-column prop="classInfo" label="门派介绍" >
                </el-table-column>
                <el-table-column prop="classAddTime" label="创建日期">
                </el-table-column>
                <el-table-column right label="操作" width="250">
                    <template slot-scope="scope">
                        <el-button @click="editor(scope.$index)" type="warning" size="mini">编辑</el-button>
                        <el-button type="danger"  size="mini" @click="deleteFaction(scope.$index)">删除</el-button>
                    </template>
                </el-table-column>
            </el-table>
        </section>
    </div>
</template>
<script>
import jsonp from 'jsonp'
export default {
    name: 'AdminFactionList',
    props: {
        prop: Object
    },
    methods: {
        editor(index) {
            var id = this.tableData[index].id;
            this.$router.push({ path: '/Admin/AdminFactionEdit/'+id }) 
        },
        getList: function() {
            jsonp("http://t.hzbiz.net/static/api/getFaction.php", null, (err, data) => {
                console.log(data.message);
                this.tableData = data.message;
                for (var i = 0; i < this.tableData.length; i++) {
                   if (this.tableData[i].isClassOpen==1) {
                      this.tableData[i].isClassOpen = "开放";
                   }else{
                      this.tableData[i].isClassOpen = "关闭";
                   }
                }
            })
        },

// @click='isClassOpen(scope.$index)'

        fnisClassOpen(index){
            console.log(index)
        },

        deleteFaction(index) {
              this.$confirm('此操作将永久删除该文件, 是否继续?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '取消',
                    type: 'warning'
              })
             .then(() => {
                var id = this.tableData[index].id;
                this.axios.get("http://t.hzbiz.net/static/api/delFaction.php?id="+id)
                .then((res)=>{
                    // console.log(res)
                    this.tableData.splice(index, 1)
                    this.$message({
                        type: 'success',
                        message: res.data.message
                    });
                })

                }).catch((error) => {
                    this.$message({
                        type: 'info',
                        message: '已取消删除'+error
                    });
                });
        }
    },
    created() {
        this.getList()
    },
    data() {
        return {
            isEditor: 0,
            tableData: [],
        }
    }
}
</script>
<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
section {
    padding: 20px;
}
</style>