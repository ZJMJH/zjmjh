<?php 

   include 'conn.php';
   $valid = true;
   $message = '';
   $key = '';

  if (isset($_POST['useremail']) && $_POST['useremail']!="") {
  	 $useremail = $_POST['useremail'];
  	 $key = "useremail";
	 $sql="SELECT * FROM user WHERE useremail ='$useremail'";

	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$valid   = false;
		$message = '邮箱'.$row['useremail'].'已经存在！';
	} else {
        // $message = '恭喜您！邮箱不存在,可以注册';
	}
  }else{
	    $valid   = false;
	    $message = '请开始输入您内容';
  }

	echo json_encode(
	    array('valid' => $valid, 'key' => $key ,'message' => $message),JSON_UNESCAPED_UNICODE
	);

   $conn->close();
 ?>