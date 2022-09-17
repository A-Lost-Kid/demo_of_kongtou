<?php
include("../core/common.php");
@header('Content-Type: text/html; charset=UTF-8');
$postid = $_REQUEST["postid"];
if(empty($postid)){ $return=array('code' => '500','msg' => '请确保输入项不为空'); echo json_encode($return,JSON_UNESCAPED_UNICODE); exit;}

$sql_res = "SELECT * FROM Post WHERE `postid`='$postid' limit 1";
$res=$DB->get_row($sql_res);
if(!$res){
    $return=array('code' => '500','msg' => '空头不存在'); echo json_encode($return,JSON_UNESCAPED_UNICODE); exit;
}else{
$title = mb_substr($res["content"],0,5)."...";
if($user_res["avatar"]==1){
$avatar = "";
}
$userid = $res["sender"];
$sql_res = "SELECT * FROM User WHERE id='$userid' limit 1";
$user_res=$DB->get_row($sql_res);

}
?>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta content="width=device-width,initial-scale=1,user-scalable=no" name="viewport">
<meta name="format-detection" content="telephone=no">
<title>【小空头】<?php echo $title;?></title>
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="mobile-web-app-capable" content="yes">
<link rel="stylesheet" href="../resources/wap/style.css">
<link rel="stylesheet" href="../resources/wap/style1.css">
<link href="../resources/css/bootstrap.min.css" rel="stylesheet">
<link href="../resources/css/materialdesignicons.min.css" rel="stylesheet">
<link href="../resources/css/style.min.css" rel="stylesheet">
</head>

<body class="ue_revision">
<div class="container-fluid p-t-15">
<div class="row">
    <div class="col-md-6">
      <div class="card">
        
        <div class="card-body">
        <div class="share_header_wrapper"><header class="share_header_title">【小空头】<?php echo $title;?></header>
	<div class="share_forum_info">
		<div class="share_forum_desc"><a href="#" class="share_forum_portrait"><img src="http://cdn.u1.huluxia.com/g3/M01/F2/06/wKgBOVxcJXeAXTNlAADqY-WVZHc098.jpg_80x80.jpeg" width="50" height="50" border="0" style="width:auto;max-width:none;"></a>
			<div class="forum_author_info"><a href=""><? echo  $user_res["username"];?></a>
				<div class="share_thread_author">
		  		<span class="list_item_time"><? echo  $res["time"];?></span>
				</div>
			</div>
		</div> 
		
	</div>
</div>

<div class="share_content_wrapper">
	
	<p><?php echo $res["content"];?></p><br>
	   
</div>
<blockquote class="blockquote">
            <p>不以物喜，不以己悲</p>
            <footer>范仲淹 <cite title="《岳阳楼记》">《岳阳楼记》</cite></footer>
          </blockquote>
        </div>
</div>
</div>
    <div class="col-md-6">
      <div class="card">
        
        <div class="card-header"><h4>关于</h4></div>
        <div class="card-body">
          <address>
            <strong>小空头</strong><br>
            此项目开源于----葫芦侠:<br>
            【J·S】总监<br>
            <abbr title="网址">网址:</abbr> <a href="http://huluxia.com" >http://huluxia.com</a>
            
          </address>
        </div>
      </div>
    </div>
  </div>
   <div class="col-sm-6 text-center">
 <div class="divider"></div>
  <p class="copyright">
   <b id="nr">Copyright &copy;<a target="_blank" href="https://lkme.cc/KAD/VEYRyeooU?uid=6729161784426649">迷路的小孩(【J·S】总监)</a> All rights reserved.</br>此作品仅供学习参考，不得用于商业用途，请下载后于24H内删除，违反后果与葫芦侠及作者本人无关<br></b>
  </p>
</div>
</div>

</div>
</div>
<script src="../resources/wap/zepto.min.js"></script>
<script type="text/javascript" src="../resources/js/jquery.min.js"></script>
<script type="text/javascript" src="../resources/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../resources/js/main.min.js"></script>
</body></html>
