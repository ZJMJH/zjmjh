<?php
/**
 * @Author: Administrator
 * @Date:   2018-06-27 20:53:13
 * @Last Modified by:   yyx219
 * @Last Modified time: 2018-06-28 11:16:36
 */
include "conn.php";
  $vaild   = true;
  $message = '';

  	if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id']!=""){
           $sqlshow = "SELECT * From user WHERE id =". $_GET['id'] ;
           $result = mysqli_query($conn,$sqlshow);  //验证是否存在
           $row = $result->fetch_assoc();
           if ($result->num_rows > 0) {

			    if ($_COOKIE['userlevel'] >= $row['userlevel']) {
					$vaild   = false;
					$message = '您不能删除同级或高级管理员';
			    }else{

                 if (isset($_GET['state'])) {
                 	if ($_GET['state']=="recovery") {

                 		$sql="UPDATE user SET isDel=0 WHERE id=".$_GET['id'];
                 		$state = '数据恢复成功';

                 	}elseif ($_GET['state']=="del") {

                 		 if ($row['isDel']==0) {
                 		 	$sql="UPDATE user SET isDel=1 WHERE id=".$_GET['id'];
                 		    $state = '数据被移入回收站'; 
                 		 }else{
                 		 	$sql="DELETE FROM user WHERE id=".$_GET['id'];
                 		 	$state = '数据被永久删除';
                 		 }

                 	}
                 	
                 }

					 if (mysqli_query($conn,$sql)) {

					    $message = $state;

					 }else{
						$vaild   = false;
						$message = '删除失败!'.$sql;
					 }
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