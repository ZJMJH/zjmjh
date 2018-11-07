<?php

/**
 * @Author: Administrator
 * @Date:   2018-07-11 17:48:30
 * @Last Modified by:   Administrator
 * @Last Modified time: 2018-07-11 17:57:46
 */

include "conn.php";
  $vaild   = true;
  $message = '';

    if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id']!=""){
           $sqlshow = "SELECT * From news WHERE id =". $_GET['id'] ;
           $result = mysqli_query($conn,$sqlshow);  //验证是否存在
           $row = $result->fetch_assoc();
           if ($result->num_rows > 0) {

           if ($row['state']==0) {
	            $sql="DELETE FROM news WHERE id=".$_GET['id'];
                $state = '新闻数据被永久删除';
             }else{
                $sql="";
                $state = '请选移入回收站后删除';
             }

           if (mysqli_query($conn,$sql)) {
              $message =  $state ;
           }else{
            $vaild   = false;
            $message = '删除失败!'.$sql;
           }


           }else{
          $vaild   = false;
          $message = '删除失败!数据不存在';
           }
   
  }else{
      $vaild   = false;
      $message = '删除失败!ID不存在';
  }

   echo json_encode(
       array('vaild' => $vaild,'message' =>$message),JSON_UNESCAPED_UNICODE
   );

   $conn->close();