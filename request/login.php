<?php
include("../core/common.php");
@header('Content-Type: text/html; charset=UTF-8');
$user = $_REQUEST["user"];
$pass = $_REQUEST["pass"];
if(empty($user) || empty($pass)){ $return=array('code' => '500','msg' => '请确保输入项不为空'); echo json_encode($return,JSON_UNESCAPED_UNICODE); exit;}
$sql_res = "SELECT * FROM User WHERE user='$user' limit 1";
$res=$DB->get_row($sql_res);
$r_user = $res["user"];
$r_pass = $res["pass"];
$r_id = $res["id"];
if(!$res || $r_pass!= $pass ){
    $return=array('code' => '500','msg' => '账号或密码输入错误'); echo json_encode($return,JSON_UNESCAPED_UNICODE); exit;
}else{
    $key = strtoupper(md5(msectime()."葫芦侠【J·S】总监"));
    $sql = "UPDATE `User` SET `key` = '$key' WHERE `user` = '$user';";
	if($DB->query($sql)){
    $return=array('code' => '200','msg' => '登录成功！！','key' => $key,'userid' => $r_id); echo json_encode($return,JSON_UNESCAPED_UNICODE);
    }else{
    $return=array('code' => '500','msg' => '数据库出错，请联系管理员'); echo json_encode($return,JSON_UNESCAPED_UNICODE); exit;
    }
}