<?php
include("../core/common.php");
@header('Content-Type: text/html; charset=UTF-8');
$type = $_REQUEST["type"];
$key = $_REQUEST["key"];
if(empty($type)){ $return=array('code' => '500','msg' => '请确保输入项不为空'); echo json_encode($return,JSON_UNESCAPED_UNICODE); exit;}
if(empty($key)){ $return=array('code' => '500','msg' => '未登录'); echo json_encode($return,JSON_UNESCAPED_UNICODE); exit;}
$sql_res = "SELECT * FROM User WHERE `key`='$key' limit 1";
$res=$DB->get_row($sql_res);
$sender = $res["id"];
if(!$res || empty($sender) ){
$return=array('code' => '500','msg' => '未登录'); echo json_encode($return,JSON_UNESCAPED_UNICODE); exit;}
if($type=="text"){
$content = $_REQUEST["content"];
if(mb_strlen($content)>=1000){
$return=array('code' => '500','msg' => '字数超出限制'); echo json_encode($return,JSON_UNESCAPED_UNICODE); exit;
}
$postid = rand(00000,999999);
$time = date("Y-m-d H:i");
$sql= "INSERT INTO `Post` (`postid`, `type`, `content`, `sender`,`look`,`time`) VALUES ('$postid', 'text', '$content','$sender','0','$time');";
if($DB->query($sql)){
  $return=array('code' => '200','msg' => '发送成功','postid'=>$postid); echo json_encode($return,JSON_UNESCAPED_UNICODE); exit;
}
}