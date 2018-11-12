<?php

include 'conn.php';
$vaild = true;
$message = '';

if ( isset( $_POST[ 'send' ] ) && $_POST[ 'send' ] == true ) {
       
    
  if (isset($_POST['className']) && $_POST['className']!="") {
    $className = stripcslashes($_POST['className']);
  }else{
    $vaild = false;
    $message = '用户名不能为空';
  }

    
  if (isset($_POST['classUserID']) && $_POST['classUserID']!="" && is_numeric($_POST['classUserID'])) {
    $classUserID = stripcslashes($_POST['classUserID']);
  }else{
    $vaild = false;
    $message = '请设置会员组管理员';
  }

    
  if (isset($_POST['classUserID']) && $_POST['classUserID']!="" && is_numeric($_POST['classUserID'])) {
    $classUserID = stripcslashes($_POST['classUserID']);
  }else{
    $vaild = false;
    $message = '请设置会员组管理员';
  }

  if (isset($_POST['classAddTime']) && $_POST['classAddTime']!="") {
    $classAddTime = $_POST['classAddTime'];
  }else{
    $classAddTime = DATETIME;
  } 
 
  if (isset($_POST['classNature']) && $_POST['classNature']!="") {
    $classNature = $_POST['classNature'];
  }else{
    $vaild = false;
    $message = '性质必须选一个';
  } 
  
  if (isset($_POST['classInfo']) && $_POST['classInfo']!="") {
    $classInfo = stripcslashes($_POST['classInfo']);
  }else{
    $vaild = false;
    $message = '信息说明不能为空';
  } 
 
    
  if (isset($_POST['isClassOpen']) && $_POST['isClassOpen']!="") {
    $isClassOpen = $_POST['isClassOpen'];
    if($isClassOpen=="true"){
      $isClassOpen = 1;
    }else{
      $isClassOpen = 0;
    }
  }else{
    $isClassOpen = false;
  } 
     

  if ($vaild) {

      if(isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id']!=""){
         $id = $_POST['id'];
         $sql="UPDATE faction SET className='$className',classInfo='$classInfo',classUserID=$classUserID,classAddTime='$classAddTime',isClassOpen=$isClassOpen,classNature='$classNature' WHERE id=".$id;
         $success  = "用户组修改成功";
      }else{
       $sql="INSERT INTO faction (className,classInfo,classUserID,classAddTime,isClassOpen,classNature) VALUES ('$className','$classInfo',$classUserID,'$classAddTime',$isClassOpen,'$classNature')";
       $success  = "用户组添加成功";
    }

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