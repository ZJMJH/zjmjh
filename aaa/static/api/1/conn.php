<?php
  header("Content-type:text/html;charset=utf-8");
  date_default_timezone_set('Asia/Shanghai');
  //报错机制
  ini_set('display_errors','On');
  error_reporting(E_ALL);

  if (!isset($_COOKIE["useremail"])){
     echo json_encode(
         array('vaild' => false,'isLogin' =>'您未登陆'),JSON_UNESCAPED_UNICODE
     );
     exit();
  }
     
  if (version_compare("5.5",PHP_VERSION,">")) {
  	  die('<h1>当前环境不符合系统要求:"'.PHP_VERSION.'"</h1>');
  };

  define('DATETIME',date("Y-m-d H:i:s"));
  
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
  	 // echo "数据库连接成功".$_COOKIE['userregtimes'];
  }

?>