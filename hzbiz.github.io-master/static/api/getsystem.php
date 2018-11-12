<?php
   include 'conn.php';
   $vaild = true;
   $message = '';
   
if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id']!=""){

	 $sql="SELECT * FROM system WHERE id=".$_GET['id'];
     $result = $conn->query($sql);
     if ($result->num_rows > 0) {
     	// $row=$result->fetch_assoc();
     	$message[] = $result->fetch_assoc();
     }else{
     	$vaild = false;
     	$message = '没有信息';
     }
}else{
     	$vaild = false;
     	$message= '没有信息';
}
 
   echo json_encode(
       array('vaild' => $vaild,'message' =>$message),JSON_UNESCAPED_UNICODE
   );

   $conn->close();
?>