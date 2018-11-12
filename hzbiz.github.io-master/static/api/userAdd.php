<?php

include 'conn.php';
$vaild = true;
$message = '';

if ( isset( $_POST[ 'send' ] ) && $_POST[ 'send' ] == true ) {
       
    
  if (isset($_POST['username']) && $_POST['username']!="") {
    $username = stripcslashes($_POST['username']);
  }else{
    $vaild = false;
    $message = '用户名不能为空';
  }

    
  if (isset($_POST['password']) && $_POST['password']!="") {
    $password = stripcslashes($_POST['password']);
    $password = sha1($password);
  }else{
    $vaild = false;
    $message = '密码不能为空';
  }

    
  if (isset($_POST['email']) && $_POST['email']!="" ) {
    $email = stripcslashes($_POST['email']);
  }else{
    $vaild = false;
    $message = '邮箱不能为空';
  }

  if (isset($_POST['tel']) && $_POST['tel']!="") {
    $tel = $_POST['tel'];
  }else{
    $vaild = false;
    $message = '电话不能为空';
  } 
 
  if (isset($_POST['faction']) && $_POST['faction']!="") {
    $faction = $_POST['faction'];
  }else{
    $vaild = false;
    $message = '门派不能为空';
  } 
  
 
    
  if (isset($_POST['status']) && $_POST['status']!="") {
    $status = $_POST['status'];
    if($status=="true"){
      $status = 1;
    }else{
      $status = 0;
    }
  }else{
    $status = false;
  } 

  if (isset($_POST['level']) && $_POST['level']!="") {
    $level = $_POST['level'];
  }else{
    $level = 0;
  } 
  
  if (isset($_POST['remark']) && $_POST['remark']!="") {
    $remark = $_POST['remark'];
  }else{
    $remark = '';
  } 

  if ($vaild) {

     
       $sql="INSERT INTO Users (username,password,email,tel,faction,status,level,remark) VALUES ('$username','$password','$email',$tel,'$faction',$status,$level,'$remark')";
       $success  = "用户组添加成功";
    

   if (mysqli_query($conn,$sql)) {
     $message  = $success;
   }else{
     $vaild = false;
     $message = "用户组添加失败".$sql;
   }

  }else{
    $vaild = false;
    $message = $message;
  }




} else {
  $vaild = false;
  $message = '请检查接口参数是否缺少send参数';
}


echo json_encode(
  array( 'vaild' => $vaild, 'message' => $message ), JSON_UNESCAPED_UNICODE
);

$conn->close();