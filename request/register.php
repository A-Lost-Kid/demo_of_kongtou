<?php
include("../core/common.php");
@header('Content-Type: text/html; charset=UTF-8');
$user = $_REQUEST["user"];
$pass = $_REQUEST["pass"];

if(empty($user) || empty($pass)){ $return=array('code' => '500','msg' => '请确保输入项不为空'); echo json_encode($return,JSON_UNESCAPED_UNICODE); exit;}

$sql_res = "SELECT * FROM User WHERE user='$user' limit 1";
$res=$DB->get_row($sql_res);
$r_user = $res["user"];
$r_id = $res["id"];
if($res || $user= $r_user ){
    $return=array('code' => '500','msg' => '用户名已存在，请更换您的用户名','userid'=> $r_id); echo json_encode($return,JSON_UNESCAPED_UNICODE); exit;
}else{
    $user = $_REQUEST["user"];
    $userid = rand(000000,9999999);
    $avatar = $siteurl."avatar.png";
    $sql = "INSERT INTO `User` (`id`, `user`, `username`, `avatar`, `pass`, `email`) VALUES ('$userid', '$user', '空头用户$userid', '$avatar', '$pass', '');";
	if($DB->query($sql)){
    $return=array('code' => '200','msg' => '注册成功，请返回登录！！','userid' => $userid); echo json_encode($return,JSON_UNESCAPED_UNICODE);
    }else{
    $return=array('code' => '500','msg' => '数据库出错，请联系管理员'); echo json_encode($return,JSON_UNESCAPED_UNICODE); exit;
    }
}