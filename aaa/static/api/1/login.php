<?php
  header("Content-type:text/html;charset=utf-8");
  date_default_timezone_set('Asia/Shanghai');
 
  //报错机制
  ini_set('display_errors','On');
  error_reporting(E_ALL);

  if (version_compare("5.5",PHP_VERSION,">")) {
      die('<h1>当前环境不符合系统要求:"'.PHP_VERSION.'"</h1>');
  };

  define('DB_HOST','localhost');
  define('DB_NAME','cms');
  define('DB_USER','root');
  define('DB_PASSWORD','yyx737828');
   
  $conn = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
  mysqli_query($conn,"set character set utf8");
  mysqli_query($conn,"set names utf8");
  if ($conn->connect_error) {
     die('数据库连接失败'.$conn->connect_error);
  }else{
     //echo "数据库连接成功".DB_NAME;
  }

$valid   = true;
$message = '';
if(isset($_POST['send']) && $_POST['send']==true){

     if (isset($_POST['useremail']) && $_POST['useremail']!="") {
           $useremail =  htmlentities($_POST['useremail'], ENT_QUOTES, 'UTF-8');
           $regexp = "/^([_a-z0-9-]+)(\.[_a-z0-9-]+)*@([a-z0-9-]+)(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/";
           if (!preg_match($regexp,$useremail)){
             $message = "邮箱帐号不合法";
             $valid   = false;
            }
      }else{
        $message = "邮箱帐号不合法";
        $valid   = false;
      }
        
      if (isset($_POST['password']) && $_POST['password']!="") {
          $password = sha1($_POST['password']);


           $sql = "SELECT * From user WHERE useremail = '$useremail' &&  password='$password'";
           $result = mysqli_query($conn,$sql);  //验证是否存在
           $row = $result->fetch_assoc();
           
             if ($row['userlevel']!=0 && mysqli_num_rows($result) == 1) {
                $message =  "帐号未授权登陆，请向管理员咨询";
                $valid   = false;
              }


      }else{
          $message = '请重新确认您的密码';
          $valid   = false;
      }






     if ($valid) {
         
         $sql = "SELECT * From user WHERE useremail = '$useremail' &&  password='$password'";
         $result = mysqli_query($conn,$sql);  //验证是否存在
         $row = $result->fetch_assoc();

        if(mysqli_num_rows($result) == 1 ){
                 
                $userlogintimes = $row['userlogintimes'].','.date("Y-m-d H:i:s");

                $sql_landing="UPDATE user SET userlogintimes='$userlogintimes' ,userlanding=userlanding+1 WHERE useremail='$useremail'";
                mysqli_query($conn,$sql_landing);

                if (isset($_POST['isSave']) && $_POST['isSave']==7) {
                	$expire=time()+60*60*24*7;
                }else{
                	$expire=time()+3600;
                }
                
                setcookie("useremail",$row['useremail'],$expire,"/");
                setcookie("username", $row['username'],$expire,"/");
                setcookie("userid", $row['id'],$expire,"/");
                setcookie("userlevel", $row['userlevel'],$expire,"/");
                setcookie("userregtimes", $row['userregtimes'],$expire,"/");
                setcookie("userlogintimes",$userlogintimes,$expire,"/");
                // $message = '{"useremail":"'.$row['useremail'].'","userlevel":"'.$row['userlevel'].'"}';
                 $message = "登陆成功";

          }else{
              $message =  "帐号或密码不正确";
              $valid   = false;
          }

     }else{
              $message = $message;
              $valid   = false;
     } 

}else{
	$valid   = false;
	$message = '接口调用失败';
}


echo json_encode(
   array('valid' => $valid, 'message' => $message),JSON_UNESCAPED_UNICODE
); 

?> 