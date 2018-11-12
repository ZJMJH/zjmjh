<?php
   include 'conn.php';
   $vaild = true;
   $message = '';

   if (isset($_POST['send']) && $_POST['send']==1) {
      
        if (isset($_POST['webTitle']) && $_POST['webTitle']!="") {
        	$title = stripcslashes($_POST['webTitle']);
        }else{
        	$vaild = false;
        	$message = '网站标题不能为空';
        }
    
        if (isset($_POST['webName']) && $_POST['webName']!="") {
        	$name = stripcslashes($_POST['webName']);
        }else{
        	$vaild = false;
        	$message = '网站名称不能为空';
        }

        if (isset($_POST['webLogo']) && $_POST['webLogo']!="") {
        	$logo = stripcslashes($_POST['webLogo']);
        }else{
        	$vaild = false;
        	$message = '网站LOGO不能为空';
        }

        if (isset($_POST['webUrl']) && $_POST['webUrl']!="") {
        	$Url = stripcslashes($_POST['webUrl']);
        }else{
        	$vaild = false;
        	$message = '网站Url不能为空';
        }

        if (isset($_POST['webEmail']) && $_POST['webEmail']!="") {
        	$Email = stripcslashes($_POST['webEmail']);
        }else{
        	$vaild = false;
        	$message = '管理员Email不能为空';
        }

        if (isset($_POST['webCopyRight']) && $_POST['webCopyRight']!="") {
        	$CopyRight = stripcslashes($_POST['webCopyRight']);
        }else{
        	$vaild = false;
        	$message = '版权信息不能为空';
        }


        if ($vaild) {

          $result = $conn->query('SELECT * FROM system');
          if ($result->num_rows > 0) {
            if(isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id']!=""){
               $id = $_POST['id'];
               $sql="UPDATE system SET title='$title',name='$name',logo='$logo',url='$Url',email='$Email',copyRight='$CopyRight' WHERE id=".$id;
            }
          }else{
             $sql="INSERT INTO system (title,name,logo,url,email,copyRight) VALUES ('$title','$name','$logo','$Url','$Email','$CopyRight')";
          }
     
         if (mysqli_query($conn,$sql)) {
         	$message  = "网站基本信息保存成功";
         }else{
         	$vaild = false;
         	$message = "网站基本信息保存失败".$sql;
         }

        }else{
        	$vaild = false;
        	$message = $message;
        }




   }else{
   	  $vaild = false;
      $message = "接口参数不正确";
   }

   echo json_encode(
       
       $vaild?array('vaild' => $vaild,'message' =>$message):array('vaild' => $vaild,'message' =>$message),JSON_UNESCAPED_UNICODE

   );

   $conn->close();
?>