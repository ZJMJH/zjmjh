<?php
include "conn.php";
  $valid   = true;
  $message = '';

if (isset($_POST['send']) && $_POST['send']==true) {
	
        if (isset($_POST['userhead']) && $_POST['userhead']!="") {
          $userhead = stripcslashes($_POST['userhead']);
        }else{
          $userhead = '../images/logo.png';
        }


        // if (isset($_POST['username']) && $_POST['username']!="") {
        //   $username = stripcslashes($_POST['username']);
        // }else{
        //    $message = "用户名不能为空";
        //    $valid   = false;
        // }



      if (isset($_POST['password']) && isset($_POST['setpassword']) && $_POST['password']!="" && $_POST['setpassword']!="") {

          $password = $_POST['password'];
          $setpassword = $_POST['setpassword'];
          
          if ($password != $setpassword) {
               $message = "初始密码和确认密码不符合";
               $valid   = false;
          }else{
              $password = sha1($password);
          }
      }else{
         $password=null;
      }

      if (isset($_POST['usersex']) && $_POST['usersex']!=""){
          $usersex = $_POST['usersex'];
      }else{
          $usersex = '1';
      }


      if (isset($_POST['userinfo']) && $_POST['userinfo']!=""){
          $userinfo = stripcslashes($_POST['userinfo']);
      }else{
          $userinfo = "";
      }

      if (isset($_POST['usersex'])){
          $usersex = $_POST['usersex'];
      }else{
         $message = "请选择用户性别";
         $valid   = false;
      }

      if (isset($_POST['userlevel'])){
          $userlevel = $_POST['userlevel'];
      }else{
         $message = "请选择用户权限等级";
         $valid   = false;
      }


      if (isset($_POST['userisdel'])){
          $userisdel = $_POST['userisdel'];
      }else{
          $userisdel = 0;
      }

     if ($valid) {
    	

       if(isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id']!=""){
         $id = $_POST['id'];
        $result = mysqli_query($conn,"SELECT * From user WHERE id=".$id);  //验证是否存在
        if(mysqli_num_rows($result) > 0 ){ 


                 // $sql="UPDATE user SET uesrname='$uesrname',userhead='$userhead',userinfo='$userinfo',usersex='$usersex',userlevel='$userlevel',isDel='$userisdel' WHERE id=".$id;


              if ($password==null) {
                 $sql="UPDATE user SET userhead='$userhead',userinfo='$userinfo',usersex='$usersex',userlevel='$userlevel',isDel='$userisdel' WHERE id=".$id;
                  $v='密码未修改';
              }else{
                 $sql="UPDATE user SET password='$password',userhead='$userhead',userinfo='$userinfo',usersex='$usersex',userlevel='$userlevel',isDel='$userisdel' WHERE id=".$id;
                  $v='密码已经修改';
              }
             

             if(mysqli_query($conn,$sql)){
                $message =  '用户修改成功!'.$v;
              }else{
                $message =  "用户修改失败!".mysqli_error($conn).$sql;
                $valid   = false;
              }
        }else{
              $message =  "信息不存在,可能被删除";
              $valid   = false;
        }

       }else{
              $message =  "id不存在";
              $valid   = false;
       }


      }else{
            $message =  $message;
            $valid   = false; 
      }

}else{
	  $valid   = false;
    $message = '接口不存在';
}


echo json_encode(
     array('valid' => $valid, 'message' => $message),JSON_UNESCAPED_UNICODE
);

$conn->close();
?>