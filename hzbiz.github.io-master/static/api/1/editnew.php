<?php
/**
 * @Author: yyx219
 * @Date:   2018-07-03 14:19:11
 * @Last Modified by:   Administrator
 * @Last Modified time: 2018-07-12 20:06:20
 */
include 'conn.php';
$vaild = true;
$message = '';

if ( isset( $_POST[ 'send' ] ) && $_POST[ 'send' ] == true ) {

  // '新闻分类表ID ，可复选',
  if ( isset( $_POST[ 'classid' ] ) && $_POST[ 'classid' ] != "" ) {
    $classid = $_POST[ 'classid' ]; //拿到分类数组
    if ( is_array( $classid ) ) {
      $classid = implode( ',', $classid );
    }
  } else {
    $vaild = false;
    $message = '新闻分类不能为空';
  }

  //取得用户提交的发布时间
  if ( isset( $_POST[ 'ReleaseTime' ] ) && $_POST[ 'ReleaseTime' ] != "" ) {
    $ReleaseTime = $_POST[ 'ReleaseTime' ];
  } else {
    $ReleaseTime = DATETIME;
  }

  if ( isset( $_COOKIE[ "userid" ] ) ) {
    $userid = $_COOKIE[ "userid" ];
  } else {
    $vaild = false;
    $message = 'Cookie失效,请重新登陆后继续操作';
  }
  
  // '新闻标题，长度255以内',
  if ( isset( $_POST[ 'title' ] ) && $_POST[ 'title' ] != "" ) {
    $title = stripcslashes( $_POST[ 'title' ] );
    $title = preg_replace( "/<([a-z]+)[^>]*>/i", "", $title );
    if ( mb_strlen( $title, 'UTF8' ) >= 255 ) {
      $vaild = false;
      $message = '新闻标题长度超过合法值请小于255';
    }
  } else {
    $vaild = false;
    $message = '新闻标题不能为空';
  }

  // '文章作者-不允许为空',
  if ( isset( $_POST[ 'author' ] ) && $_POST[ 'author' ] != "" ) {
    $author = $_POST[ 'author' ];
  } else {
    $vaild = false;
    $message = 'Cookie失效,请重新登陆后继续操作';
  }

  // '文章来源-允许为空',
  if ( isset( $_POST[ 'source' ] ) && $_POST[ 'source' ] != "" ) {
    $source = $_POST[ 'source' ];
  } else {
    $source = '';
  }


  // '特色图片，可以上传多图，最多20张，以数组形式存入',
  if ( isset( $_POST[ 'imgurl' ] ) && $_POST[ 'imgurl' ] != "" ) {
    $imgurl = $_POST[ 'imgurl' ];
  } else {
    $imgurl = '';
  }

  // '文章主图',
  if ( isset( $_POST[ 'mainpicture' ] ) && $_POST[ 'mainpicture' ] != "" ) {
    $mainpicture = $_POST[ 'mainpicture' ];
  } else {
    $mainpicture = '';
  }


  if ( isset( $_POST[ 'label' ] ) && $_POST[ 'label' ] != "" ) {
    $label = $_POST[ 'label' ];
  } else {
    $label = '';
  }

  //   abstract varchar(5000) DEFAULT NULL COMMENT '简述文章概要 500字以内，可以为空',
  if ( isset( $_POST[ 'abstract' ] ) && $_POST[ 'abstract' ] != "" ) {
    $abstract = stripcslashes( $_POST[ 'abstract' ] );
    // $abstract = preg_replace('/\s(?!src)[a-zA-Z]+=[\'\"]{1}[^\'\"]+[\'\"]{1}/iu',$abstract); 
    if ( mb_strlen( $abstract, 'UTF8' ) >= 255 ) {
      $vaild = false;
      $message = '新闻简介长度超过合法值请小于500';
    }

  } else {
    $abstract = '';
  }


  if ( isset( $_POST[ 'content' ] ) && $_POST[ 'content' ] != "" ) {
    $content = stripcslashes( $_POST[ 'content' ] );
  } else {
    $vaild = false;
    $message = '文章内容不能为空';
  }

  //是否允许用户评论   -0表示不允许，  1表示允许',
  $discuss = $_POST[ 'discuss' ];

  // '新闻状态 0表示回收站存稿，1表示正常发布',
  $state = $_POST[ 'state' ];

  //  '0 输入密码可以查看，1表示私有仅发布者本身允许查看，2表示注册用户查看，3表示完全公开',
  $openness = $_POST[ 'openness' ];
  if ( $openness == 0 ) {
    if ( isset( $_POST[ 'opennessPassword' ] ) && $_POST[ 'opennessPassword' ] != "" ) {
      $opennessPassword = sha1( $_POST[ 'opennessPassword' ] );
    } else {
      $vaild = false;
      $message = '公开度选择密码时必须输入对应的密码';
    }
  } else {
    $opennessPassword = "";
  }

  if ( isset( $_POST[ 'hits' ] ) && is_numeric( $_POST[ 'hits' ] ) && $_POST[ 'hits' ] != "" ) {
    if ( preg_match( '/^[0-9]+$/', $_POST[ 'hits' ] ) ) {
      $hits = $_POST[ 'hits' ];
    } else {
      $vaild = false;
      $message = '阅读次数，必须是数字,默认为0';
    }

  } else {
    $hits = 0;
  }

  if ( $vaild ) {


    // var_dump($_POST);

    // $sql = "INSERT INTO news (classid, userid, title, abstract, content, ReleaseTime, author, source, imgurl, mainpicture, discuss, label, state, openness, opennessPassword,hits) VALUES ('$classid', $userid, '$title', '$abstract', '$content', '$ReleaseTime', '$author', '$source', '$imgurl', '$mainpicture', $discuss, '$label', $state, $openness, '$opennessPassword',$hits)";
      $sql = "UPDATE news SET classid='$classid',userid=$userid,title='$title',abstract='$abstract',content='$content',ReleaseTime='$ReleaseTime',author='$author',source='$source',imgurl='$imgurl',mainpicture='$mainpicture',discuss=$discuss,label='$label',state=$state,openness=$openness,opennessPassword='$opennessPassword',hits=$hits WHERE id=". $_POST['id'] ;

    if ( mysqli_query( $conn, $sql ) ) {
      $message = "新闻修改成功";
    } else {
      $vaild = false;
      $message = "新闻发布失败" . $sql;
    }
  }



} else {
  $vaild = false;
  $message = '请检查接口参数是否缺少send参数';
}


echo json_encode(
  array( 'vaild' => $vaild, 'message' => $message ), JSON_UNESCAPED_UNICODE
);

$conn->close();