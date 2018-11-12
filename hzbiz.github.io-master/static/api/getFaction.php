<?php
   header("Context-type:text/html;charset=utf-8");
   //  声明文件的编码格式，采用utf8
   date_default_timezone_set('Asia/Shanghai');
   // 设置当前时区为中国上海时区

  
   ini_set('display_errors','On');
   error_reporting(E_ALL);
   // 报错机制

   define('DATETIME',date("Y-m-d H:i:s"));
   define('DATE',date("Y-m-d"));
   // 时间

   define('DBHOST','localhost');
   define('DBUSER','root');
   define('DBPASS','yyx737828');
   define('DBNAME','0718');

   $conn = new mysqli(DBHOST,DBUSER,DBPASS,DBNAME);
   mysqli_query($conn,"set character set utf8");
   mysqli_query($conn,"set names utf8");
   
   if($conn->connect_error){
       die('数据库连接失败'.$conn->connect_error);
   }else{
       // echo json_encode(
       //     array('vaild'=>true,'success'=>'数据库连接成功'.DATE),JSON_UNESCAPED_UNICODE
       // );
   }

   $vaild = true;
   $message = '';

   if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id']!=""){
        $sql="SELECT * FROM faction WHERE id=".$_GET['id'];
    }else{
        $sql="SELECT * FROM faction";
    }

$result = $conn->query($sql);
if ($result->num_rows > 0) {
   // 输出数据
   while($row = $result->fetch_assoc()) {
       $message[] = $row;
   }
} else {
   $vaild = false;
    $message[]='没有信息';
}


if(isset($_GET['callback'])){
    $callback = $_GET['callback'];
    echo $callback.'('.json_encode(array('vaild' => $vaild,'message' =>$message),JSON_UNESCAPED_UNICODE).')';
}


echo json_encode(
    array('vaild' => $vaild,'message' =>$message),JSON_UNESCAPED_UNICODE
);

$conn->close();

?>