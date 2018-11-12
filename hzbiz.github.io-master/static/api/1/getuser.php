<?php
   include 'conn.php';
   $vaild = true;
   $users = '';
   
	if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id']!=""){
		 $sql="SELECT id,username,userhead,usersex,useremail,userregtimes,userlanding,userlogintimes,userinfo,userlevel,isDel FROM user WHERE id=".$_GET['id'];
	}else{
		 $sql="SELECT id,username,userhead,usersex,useremail,userregtimes,userlanding,userlogintimes,userinfo,userlevel,isDel FROM user";
	}

	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	    // 输出数据
	    while($row = $result->fetch_assoc()) {
	    	$users[] = $row;
	    }
	} else {
	    $vaild = false;
     	$users[]='没有信息';
	}

	   echo json_encode(
       array('vaild' => $vaild,'users' =>$users),JSON_UNESCAPED_UNICODE
   );

   $conn->close();


?>