<?php
include("../core/common.php");
@header('Content-Type: text/html; charset=UTF-8');
$postid = $_REQUEST["postid"];
$key = $_REQUEST["key"];
if(empty($postid)){ $return=array('code' => '500','msg' => '请确保输入项不为空'); echo json_encode($return,JSON_UNESCAPED_UNICODE); exit;}
if(empty($key)){ $return=array('code' => '500','msg' => '未登录'); echo json_encode($return,JSON_UNESCAPED_UNICODE); exit;}
$sql_res = "SELECT * FROM User WHERE `key`='$key' limit 1";
$res=$DB->get_row($sql_res);
$sender = $res["id"];
if(!$res || empty($sender) ){
$return=array('code' => '500','msg' => '未登录'); echo json_encode($return,JSON_UNESCAPED_UNICODE); exit;}
$sql_res = "SELECT * FROM Post WHERE `postid`='$postid' limit 1";
$res=$DB->get_row($sql_res);
if(!$res){
    $return=array('code' => '500','msg' => '空头不存在'); echo json_encode($return,JSON_UNESCAPED_UNICODE); exit;
}else{
    $n=$res["look"]+1;
    $sql = "UPDATE `Post` SET `look` = '$n' WHERE `postid` = '$postid';";
    $userid = $res["sender"];
    $sql_res = "SELECT * FROM User WHERE id='$userid' limit 1";
    $user_res=$DB->get_row($sql_res);
	if($DB->query($sql)){
   $return=array('code' => '200','msg' => '查询成功','type'=> $res["type"],'content'=> $res["content"],'images'=> $res["images"],'video'=> $res["video"],'sender'=> array('userid'=> $user_res["id"],'username'=> $user_res["username"],'avatar'=> $user_res["avatar"]),'look'=> $res["look"],'time'=> $res["time"]); echo json_encode($return,JSON_UNESCAPED_UNICODE); exit;
    }else{
    $return=array('code' => '500','msg' => '数据库出错，请联系管理员'); echo json_encode($return,JSON_UNESCAPED_UNICODE); exit;
    }
}