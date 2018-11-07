<?php
   include 'conn.php';
   $vaild = true;
   $news = '';
   
	if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id']!=""){
		 $sql="SELECT * FROM news WHERE id=".$_GET['id'];
	}else{
		 $sql="SELECT * FROM news";
	}

	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	    // 输出数据
	    while($row = $result->fetch_assoc()) {
	    	$news[] = $row;
	    }
	} else {
	    $vaild = false;
     	$news[]='没有信息';
	}

	   echo json_encode(
       array('vaild' => $vaild,'news' =>$news),JSON_UNESCAPED_UNICODE
   );

   $conn->close();


?>