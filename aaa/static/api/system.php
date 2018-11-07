<?php
   include 'conn.php';
   $vaild = true;
   $message = '';

   if (isset($_POST['send']) && $_POST['send']==true) {
      
        if (isset($_POST['title']) && $_POST['title']!="") {
        	$title = stripcslashes($_POST['title']);
        }else{
        	$vaild = false;
        	$message = '网站标题不能为空';
        }
    
        if (isset($_POST['name']) && $_POST['name']!="") {
        	$name = stripcslashes($_POST['name']);
        }else{
        	$vaild = false;
        	$message = '网站名称不能为空';
        }

        if (isset($_POST['fileListName']) && $_POST['fileListName']!="") {
        	$fileListName = stripcslashes($_POST['fileListName']);
        }else{
        	$fileListName = "";
        }

        if (isset($_POST['fileListUrl']) && $_POST['fileListUrl']!="") {
        	$fileListUrl = stripcslashes($_POST['fileListUrl']);
        }else{
        	$fileListUrl = "";
        }


        if (isset($_POST['http']) && $_POST['http']!="") {
        	$http = stripcslashes($_POST['http']);
        }else{
        	$vaild = false;
        	$message = '网站Url不能为空';
        }

        if (isset($_POST['dynamicTags']) && $_POST['dynamicTags']!="") {
        	$dynamicTags = stripcslashes($_POST['dynamicTags']);
        }else{
        	$dynamicTags = "";
        }

        if (isset($_POST['description']) && $_POST['description']!="") {
        	$description = stripcslashes($_POST['description']);
        }else{
        	$vaild = false;
        	$message = '版权信息不能为空';
        }

        if (isset($_POST['copyright']) && $_POST['copyright']!="") {
        	$CopyRight = stripcslashes($_POST['copyright']);
        }else{
        	$vaild = false;
        	$message = '版权信息不能为空';
        }


        if ($vaild) {

          $result = $conn->query('SELECT * FROM system');
          if ($result->num_rows > 0) {
            if(isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id']!=""){
               $id = $_POST['id'];
               $sql="UPDATE system SET title = '$title', name ='$name' , fileListName = '$fileListName', fileListUrl = '$fileListUrl', http = '$http', dynamicTags = '$dynamicTags', description = '$description', copyright = '$CopyRight' WHERE id = ".$id;
            }
          }else{
             $sql="INSERT INTO system (title,name,fileListName,fileListUrl,http,dynamicTags,description,copyright) VALUES ('$title','$name','$fileListName','$fileListUrl','$http','$dynamicTags','$description','$copyright')";
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