<?php
include "conn.php";
  $vaild   = true;
  $message = '';

    if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id']!=""){
           $sql = "SELECT * From faction WHERE id =". $_GET['id'] ;
           $result = mysqli_query($conn,$sql);  //验证是否存在
           $row = $result->fetch_assoc();
           if ($result->num_rows > 0) {

	            $sql="DELETE FROM faction WHERE id=".$_GET['id'];
     
           if (mysqli_query($conn,$sql)) {
              $message = "门派被灭了" ;
           }else{
            $vaild   = false;
            $message = '我们顽强的生存下来了!'.$sql;
           }


           }else{
              $vaild   = false;
              $message = '我们已经被灭了，不能死两回';
           }
   
  }else{
      $vaild   = false;
      $message = '已经我存在，你没有找到路';
  }

   echo json_encode(
       array('vaild' => $vaild,'message' =>$message),JSON_UNESCAPED_UNICODE
   );

   $conn->close();