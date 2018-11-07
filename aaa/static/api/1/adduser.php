<?php
include "conn.php";
  $valid   = true;
  $message = '';

if (isset($_POST['send']) && $_POST['send']==true) {
	
      
        if (isset($_POST['username']) && $_POST['username']!="") {
          $username = stripcslashes($_POST['username']);
        }else{
          $vaild = false;
          $message = '用户名不能为空';
        }


        if (isset($_POST['userhead']) && $_POST['userhead']!="") {
          $userhead = stripcslashes($_POST['userhead']);
        }else{
          $userhead = '../images/logo.png';
        }

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
         $message = "密码不能为空";
         $valid   = false;
      }


      if (isset($_POST['usersex']) && $_POST['usersex']!=""){
          $usersex = $_POST['usersex'];
      }else{
          $usersex = '男';
      }


        if (isset($_POST['useremail']) && $_POST['useremail']!="") {
           $useremail = htmlentities($_POST['useremail'], ENT_QUOTES, 'UTF-8');
           $regexp = "/^([_a-z0-9-]+)(\.[_a-z0-9-]+)*@([a-z0-9-]+)(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/";
         if (!preg_match($regexp,$useremail)){
             $message = "邮箱不合法";
             $valid   = false;
            }
        }else{
          $message = "邮箱不合法";
          $valid   = false;
        }


     $userregtimes = DATETIME;
     $userlanding = 0;
     $userlogintimes = DATETIME;

      if (isset($_POST['userinfo']) && $_POST['userinfo']!=""){
          $userinfo = $_POST['userinfo'];
      }else{
         $userinfo = '';
      }

    

      if (isset($_POST['userlevel'])){
          $userlevel = $_POST['userlevel'];
      }else{
         $message = "请选择用户权限等级";
         $valid   = false;
      }





     if ($valid) {
    	
		
        $result = mysqli_query($conn,"SELECT * From user WHERE (useremail =  '$useremail') || (username='$username') ");  //验证是否存在
        if(mysqli_num_rows($result) == 0 ){ 

             $sql="INSERT INTO user (username,userhead,password,usersex,useremail,userregtimes,userlanding,userlogintimes,userinfo,userlevel) VALUES ('$username','$userhead','$password','$usersex','$useremail','$userregtimes',$userlanding,'$userlogintimes','$userinfo',$userlevel)";

             if(mysqli_query($conn,$sql)){
                $message =  '用户注册成功!';
              }else{
                $message =  "用户注册失败!".mysqli_error($conn).$sql;
                $valid   = false;
              }
        }else{
              $message =  "邮箱可能已经存在！请重新输入";
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