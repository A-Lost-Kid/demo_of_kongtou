<?php
include("../core/common.php");
@header('Content-Type: text/html; charset=UTF-8');
$userid = $_REQUEST["userid"];
$key = $_REQUEST["key"];
if(empty($userid)){ $return=array('code' => '500','msg' => '请确保输入项不为空'); echo json_encode($return,JSON_UNESCAPED_UNICODE); exit;}
$sql_res = "SELECT * FROM User WHERE `id`='$userid' AND `key`='$key' limit 1";
$res=$DB->get_row($sql_res);
if($res){
$return=array('code' => '200','msg' => '查询成功','userid'=> $res["id"],'username'=> $res["username"],'avatar'=> $res["avatar"],'email'=> $res["email"]); echo json_encode($return,JSON_UNESCAPED_UNICODE); exit;
}else{
$sql_res = "SELECT * FROM User WHERE id='$userid' limit 1";
$res=$DB->get_row($sql_res);
if(!$res){
    $return=array('code' => '500','msg' => '用户不存在'); echo json_encode($return,JSON_UNESCAPED_UNICODE); exit;
}else{
   $return=array('code' => '200','msg' => '查询成功','userid'=> $res["id"],'username'=> $res["username"],'avatar'=> $res["avatar"]); echo json_encode($return,JSON_UNESCAPED_UNICODE); exit;
}
}