<?php
function get_curl($url,$post=0,$referer=0,$cookie=0,$header=0,$ua=0,$nobaody=0,$addheader=0){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	$httpheader[] = "Accept: */*";
	$httpheader[] = "Accept-Encoding: gzip,deflate,sdch";
	$httpheader[] = "Accept-Language: zh-CN,zh;q=0.8";
	$httpheader[] = "Connection: close";
	if($addheader){
		$httpheader = array_merge($httpheader, $addheader);
	}
	curl_setopt($ch, CURLOPT_TIMEOUT, 30);
	if($post){
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	}
	curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);
	if($header){
		curl_setopt($ch, CURLOPT_HEADER, TRUE);
	}
	if($cookie){
		curl_setopt($ch, CURLOPT_COOKIE, $cookie);
	}
	if($referer){
		if($referer==1){
			curl_setopt($ch, CURLOPT_REFERER, 'http://m.qzone.com/infocenter?g_f=');
		}else{
			curl_setopt($ch, CURLOPT_REFERER, $referer);
		}
	}
	if($ua){
		curl_setopt($ch, CURLOPT_USERAGENT,$ua);
	}else{
		curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Safari/537.36');
	}
	if($nobaody){
		curl_setopt($ch, CURLOPT_NOBODY,1);
	}
	curl_setopt($ch, CURLOPT_ENCODING, "gzip");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	$ret = curl_exec($ch);
	curl_close($ch);
	return $ret;
}
function fengchao($html) {
    $contents="";
    preg_match_all("/<p>[^>]+>/i",$html,$content);
    $content = $content[0];
    foreach ($content as $g) {
        //$pnr=str_replace("</p>","",str_replace("<p>","",$g));
        $pnr=$g;
        if(strpos($pnr, "<a")){continue ;}else{
        $contents=$contents."\n".$pnr;
        if (empty($src) ) {
            continue ;
        }
        }
    }
    return $contents;
}
function delDir(string $path): bool
{
   if (!is_dir($path)) {
       return false;
   }
   $content = scandir($path);
   foreach ($content as $v) {
       if ('.' == $v || '..' == $v) {
           continue;
       }
       $item = $path . '/' . $v;
       if (is_file($item)) {
           unlink($item);
           continue;
       }
       delDir($item);
   }
   return rmdir($path);
}
function msectime() {
    list($msec, $sec) = explode(' ', microtime());
    $msectime = (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
    return intval($msectime);
}
function  scurl ($url,$wp,$data,$cookie,$referer,$user_agent){
	$ch=curl_init($url);
	switch($user_agent){
	    case 1:
	        curl_setopt($ch,CURLOPT_USERAGENT ,'Mozilla/5.0 (Linux; Android 5.1.1; Nexus 6 Build/LYZ28E) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.87 Mobile Safari/537.36');
	        break;
	    case 2:
	        curl_setopt($ch,CURLOPT_USERAGENT ,'Mozilla/5.0 (iPhone; CPU iPhone OS 9_1 like Mac OS X) AppleWebKit/601.1.46 (KHTML, like Gecko) Version/9.0 Mobile/13B143 Safari/601.1');
	        break;
	    case 3:
	        curl_setopt($ch,CURLOPT_USERAGENT ,'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/60.0.3112.78 Safari/537.36');
	        break;
	    case 4:
	        curl_setopt($ch,CURLOPT_USERAGENT ,'Mozilla/5.0 (Symbian/3; Series60/5.2 NokiaN8-00/012.002; Profile/MIDP-2.1 Configuration/CLDC-1.1 ) AppleWebKit/533.4 (KHTML, like Gecko) NokiaBrowser/7.3.0 Mobile Safari/533.4 3gpp-gba');
	        break;
	        
	    default:
	        curl_setopt($ch,CURLOPT_USERAGENT ,$user_agent);
	        break;
	}
	curl_setopt($ch,CURLOPT_RETURNTRANSFER ,1);
	if(strlen($cookie)>0){
	    curl_setopt($ch,CURLOPT_COOKIE ,$cookie);
	}
	if(strlen($referer)>0){
	    curl_setopt($ch, CURLOPT_REFERER,$referer);
	}
	if ($wp=1){
		curl_setopt($ch,CURLOPT_POST ,1);
		curl_setopt($ch,CURLOPT_POSTFIELDS ,$data);
	}
	return curl_exec($ch);
	curl_close($ch);
}
function imagecropper($source_path,$to)
{
$source_info = getimagesize($source_path);
$source_width = $source_info[0];
$target_width = $source_width;
$source_height = $source_info[1];
$target_height = $source_height-80;
$source_mime = $source_info['mime'];
$source_ratio = $source_height / $source_width;
$target_ratio = $target_height / $target_width;

// 源图过高
if ($source_ratio > $target_ratio)
{
$cropped_width = $source_width;
$cropped_height = $source_width * $target_ratio;
$source_x = 0;
$source_y = ($source_height - $cropped_height) / 2;
}
// 源图过宽
elseif ($source_ratio < $target_ratio)
{
$cropped_width = $source_height / $target_ratio;
$cropped_height = $source_height;
$source_x = ($source_width - $cropped_width) / 2;
$source_y = 0;
}
// 源图适中
else
{
$cropped_width = $source_width;
$cropped_height = $source_height;
$source_x = 0;
$source_y = 0;
}

switch ($source_mime)
{
case 'image/jpeg':
$source_image = imagecreatefromjpeg($source_path);
break;

case 'image/png':
$source_image = imagecreatefrompng($source_path);
break;

default:
return false;
break;
}

$target_image = imagecreatetruecolor($target_width, $target_height);
$cropped_image = imagecreatetruecolor($cropped_width, $cropped_height);

// 裁剪
imagecopy($cropped_image, $source_image, 0, 0, $source_x, $source_y, $cropped_width, $cropped_height);
// 缩放
imagecopyresampled($target_image, $cropped_image, 0, 0, 0, 0, $target_width, $target_height, $cropped_width, $cropped_height);

//保存图片到本地(两者选一)
$randNumber = mt_rand(00000, 99999). mt_rand(000, 999);
$fileName = substr(md5($randNumber), 8, 16) .".jpg";
imagepng($target_image,$to.$fileName);
imagedestroy($target_image);
unlink($source_path);
}
function gethlx($url,$post=0){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	$httpheader[] = "Accept: */*";
	$httpheader[] = "Accept-Encoding: gzip";
	$httpheader[] = "Connection: close";
	curl_setopt($ch, CURLOPT_TIMEOUT, 45);
	if($post){
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	}
	curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);
	curl_setopt($ch, CURLOPT_USERAGENT,'okhttp/3.8.1');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch, CURLOPT_ENCODING, "gzip");
	$return = curl_exec($ch);
	curl_close($ch);
	return $return;
}

function getjike($url,$cookie,$httpheader,$post=0){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL,$url);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_TIMEOUT, 45);
     curl_setopt($ch, CURLOPT_HTTPHEADER, $httpheader);
     curl_setopt($ch, CURLOPT_COOKIE, $cookie);
     if($post){
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
	}
     curl_setopt($ch, CURLOPT_USERAGENT,'okhttp/4.9.2');	
     curl_setopt($ch, CURLOPT_ENCODING, "gzip");
     curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
	$rp = curl_exec($ch);
	curl_close($ch);
	return $rp;
}

function upload_file($url,$filename,$path,$type){
        //php 5.5以上的用法
    if (class_exists('\CURLFile')) {
       $data = array('file' => new \CURLFile(realpath($path),$type,$filename));
    } else {
       $data = array(
           'file'=>'@'.realpath($path).";type=".$type.";filename=".$filename
          );
    }
     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $url);
     curl_setopt($ch, CURLOPT_POST, true );
     curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
     curl_setopt($ch, CURLOPT_HEADER, false);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
     $return_data = curl_exec($ch);
     curl_close($ch);
     return $return_data;
    }
   

function real_ip($type=0){
$ip = $_SERVER['REMOTE_ADDR'];
if($type<=0 && isset($_SERVER['HTTP_X_FORWARDED_FOR']) && preg_match_all('#\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}#s', $_SERVER['HTTP_X_FORWARDED_FOR'], $matches)) {
	foreach ($matches[0] AS $xip) {
		if (filter_var($xip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
			$ip = $xip;
			break;
		}
	}
} elseif ($type<=0 && isset($_SERVER['HTTP_CLIENT_IP']) && filter_var($_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
	$ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif ($type<=1 && isset($_SERVER['HTTP_CF_CONNECTING_IP']) && filter_var($_SERVER['HTTP_CF_CONNECTING_IP'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
	$ip = $_SERVER['HTTP_CF_CONNECTING_IP'];
} elseif ($type<=1 && isset($_SERVER['HTTP_X_REAL_IP']) && filter_var($_SERVER['HTTP_X_REAL_IP'], FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
	$ip = $_SERVER['HTTP_X_REAL_IP'];
}
return $ip;
}
function cut($str,$begin,$end){
 
    $b = mb_strpos($str,$begin) + mb_strlen($begin);
 
    $e = mb_strpos($str,$end) - $b;
 
    return mb_substr($str,$b,$e);
 
}
function get($input, $start, $end) {
 $substr = substr($input, strlen($start)+strpos($input, $start),(strlen($input) - strpos($input, $end))*(-1));
 return $substr;
}

function notification($nrs)
{
echo '
<button type="button" style="display:none;" class="btn btn-round btn-success" data-toggle="modal" data-target="#notification" data-whatever="@mdo" id="cli" onclick=""></button>
            <div class="modal fade" id="notification" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title" id="exampleModalLabel">通知</h4>
                </div>
                <div class="modal-body">
                  '.$nrs.'
                  </div>
                  <div class="modal-footer">
                  <button type="button" class="btn btn-success" data-dismiss="modal">✓知道了</button>
                </div>
              </div>
            </div>
            </div>
<script type="text/javascript">
document.getElementById("cli").click();
</script>
';
}

function get_ip_city($ip)
{
    $url = 'http://whois.pconline.com.cn/ipJson.jsp?json=true&ip=';
    $city = get_curl($url . $ip);
	$city = mb_convert_encoding($city, "UTF-8", "GB2312");
    $city = json_decode($city, true);
    if ($city['city']) {
        $location = $city['pro'].$city['city'];
    } else {
        $location = $city['pro'];
    }
	if($location){
		return $location;
	}else{
		return false;
	}
}
function daddslashes($string) {
	if(is_array($string)) {
		foreach($string as $key => $val) {
			$string[$key] = daddslashes($val);
		}
	} else {
		$string = addslashes($string);
	}
	return $string;
}

function strexists($string, $find) {
	return !(strpos($string, $find) === FALSE);
}

function dstrpos($string, $arr) {
	if(empty($string)) return false;
	foreach((array)$arr as $v) {
		if(strpos($string, $v) !== false) {
			return true;
		}
	}
	return false;
}

function GrabImage($url, $dir, $filename){
 if(empty($url)){
  return false;
 }
 $dir = realpath($dir);
 $filename = $dir . (empty($filename) ? '/'.time().$ext : '/'.$filename);
 ob_start(); 
 readfile($url); 
 $img = ob_get_contents(); 
 ob_end_clean(); 
 $size = strlen($img); 
 $fp2 = fopen($filename , "a"); 
 fwrite($fp2, $img); 
 fclose($fp2); 
 return $filename;
}

function checkmobile() {
	$useragent = strtolower($_SERVER['HTTP_USER_AGENT']);
	$ualist = array('android', 'midp', 'nokia', 'mobile', 'iphone', 'ipod', 'blackberry', 'windows phone');
	if((dstrpos($useragent, $ualist) || strexists($_SERVER['HTTP_ACCEPT'], "VND.WAP") || strexists($_SERVER['HTTP_VIA'],"wap"))){
		return true;
	}else{
		return false;
	}
}
function checkEmail($value)
{
	if (preg_match("/^[\w\.\-]+@\w+([\.\-]\w+)*\.\w+$/", $value) && strlen($value) <= 60) {
		return true;
	} else {
		return false;
	}
}
/**
 * 取中间文本
 * @param string $str
 * @param string $leftStr
 * @param string $rightStr
 */
function getSubstr($str, $leftStr, $rightStr)
{
	$left = strpos($str, $leftStr);
	$start = $left+strlen($leftStr);
	$right = strpos($str, $rightStr, $start);
	if($left < 0) return '';
	if($right>0){
		return substr($str, $start, $right-$start);
	}else{
		return substr($str, $start);
	}
}

function authcode($string, $operation = 'DECODE', $key = '', $expiry = 0) {global $authcode;	if ($key == "daishuaba_cloudkey2" and $string != "9864c3j6y0rHTqywfV62eDHr2bnVcq1zwne8Xe5hoEfkrRCTxA") {		$string = "{\"code\":1,\"authcode\":\"" . $authcode . "\"}";		return $string;	}
	$ckey_length = 4;
	$key = md5($key);
	$keya = md5(substr($key, 0, 16));
	$keyb = md5(substr($key, 16, 16));
	$keyc = $ckey_length ? ($operation == 'DECODE' ? substr($string, 0, $ckey_length): substr(md5(microtime()), -$ckey_length)) : '';
	$cryptkey = $keya.md5($keya.$keyc);
	$key_length = strlen($cryptkey);
	$string = $operation == 'DECODE' ? base64_decode(substr($string, $ckey_length)) : sprintf('%010d', $expiry ? $expiry + time() : 0).substr(md5($string.$keyb), 0, 16).$string;
	$string_length = strlen($string);
	$result = '';
	$box = range(0, 255);
	$rndkey = array();
	for($i = 0; $i <= 255; $i++) {
		$rndkey[$i] = ord($cryptkey[$i % $key_length]);
	}
	for($j = $i = 0; $i < 256; $i++) {
		$j = ($j + $box[$i] + $rndkey[$i]) % 256;
		$tmp = $box[$i];
		$box[$i] = $box[$j];
		$box[$j] = $tmp;
	}
	for($a = $j = $i = 0; $i < $string_length; $i++) {
		$a = ($a + 1) % 256;
		$j = ($j + $box[$a]) % 256;
		$tmp = $box[$a];
		$box[$a] = $box[$j];
		$box[$j] = $tmp;
		$result .= chr(ord($string[$i]) ^ ($box[($box[$a] + $box[$j]) % 256]));
	}
	if($operation == 'DECODE') {
		if((substr($result, 0, 10) == 0 || substr($result, 0, 10) - time() > 0) && substr($result, 10, 16) == substr(md5(substr($result, 26).$keyb), 0, 16)) {
			return substr($result, 26);
		} else {
			return '';
		}
	} else {
		return $keyc.str_replace('=', '', base64_encode($result));
	}
}

function get_img($html) {
    $imgs = array();
    if (empty($html)) return $imgs;
    preg_match_all("/<img[^>]+>/i",$html,$img);
    if (empty($img)) return $imgs;
    $img = $img[0];
    foreach ($img as $g) {
        $g = preg_replace("/^<img|>$/i", '',$g);
        preg_match("/\ssrc\s*\=\s*\"([^\"]+)|\ssrc\s*\=\s*'([^']+)|\ssrc\s*\=\s*([^\"'\s]+)/i", $g, $src);
        $src= empty($src) ? '': $src[count($src) - 1];
        if (empty($src) ) {
            continue ;
        }
        $coun=sizeof($imgs);
        if($coun<10){
        $imgs[] = array('src' => $src);
        }else{
        $imgs[] = array('src' => $src);
        array_splice($imgs, 1, 1);
        }
    }
    return $imgs;
}

function get_img_1($html) {
    $imgs = array();
    if (empty($html)) return $imgs;
    preg_match_all("/<img[^>]+>/i",$html,$img);
    if (empty($img)) return $imgs;
    $img = $img[0];
    foreach ($img as $g) {
        $g = preg_replace("/^<img|>$/i", '',$g);
        preg_match("/\ssrc\s*\=\s*\"([^\"]+)|\ssrc\s*\=\s*'([^']+)|\ssrc\s*\=\s*([^\"'\s]+)/i", $g, $src);
        $src= empty($src) ? '': $src[count($src) - 1];
        if (empty($src) ) {
            continue ;
        }
        $coun=sizeof($imgs);
        if($coun<9){
        $imgs[] = array('src' => $src);
        }else{
        $imgs[] = array('src' => $src);
        array_splice($imgs, 1, 1);
        }
    }
    return $imgs;
}

function random($length, $numeric = 0) {
	$seed = base_convert(md5(microtime().$_SERVER['DOCUMENT_ROOT']), 16, $numeric ? 10 : 35);
	$seed = $numeric ? (str_replace('0', '', $seed).'012340567890') : ($seed.'zZ'.strtoupper($seed));
	$hash = '';
	$max = strlen($seed) - 1;
	for($i = 0; $i < $length; $i++) {
		$hash .= $seed[mt_rand(0, $max)];
	}
	return $hash;
}
function get_rand($proArr)
{
	$result = "";
	$proSum = array_sum($proArr);
	foreach ($proArr as $key => $proCur) {
		$randNum = mt_rand(1, $proSum);
		if ($randNum <= $proCur) {
			$result = $key;
			break;
		}
		$proSum -= $proCur;
	}
	unset($proArr);
	return $result;
}
function showmsg($content = '未知的异常',$type = 4,$back = false)
{
switch($type)
{
case 1:
	$panel="success";
break;
case 2:
	$panel="info";
break;
case 3:
	$panel="warning";
break;
case 4:
	$panel="danger";
break;
}

echo '<div class="panel panel-'.$panel.'">
      <div class="panel-heading">
        <h3 class="panel-title">提示信息</h3>
        </div>
        <div class="panel-body">';
echo $content;

if ($back) {
	echo '<hr/><a href="'.$back.'"><< 返回上一页</a>';
}
else
    echo '<hr/><a href="javascript:history.back(-1)"><< 返回上一页</a>';

echo '</div>
    </div>';
exit;
}

if(!function_exists("is_https")){
	function is_https() {
		if(isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443){
			return true;
		}elseif(isset($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) == 'on' || $_SERVER['HTTPS'] == '1')){
			return true;
		}elseif(isset($_SERVER['HTTP_X_CLIENT_SCHEME']) && $_SERVER['HTTP_X_CLIENT_SCHEME'] == 'https'){
			return true;
		}elseif(isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https'){
			return true;
		}elseif(isset($_SERVER['REQUEST_SCHEME']) && $_SERVER['REQUEST_SCHEME'] == 'https'){
			return true;
		}elseif(isset($_SERVER['HTTP_EWS_CUSTOME_SCHEME']) && $_SERVER['HTTP_EWS_CUSTOME_SCHEME'] == 'https'){
			return true;
		}
		return false;
	}
}

function check_china(){
	$ip = gethostbyname('check.cccyun.cc');
	if($ip == '192.168.0.1'){
		return true;
	}else{
		return false;
	}
}
function yile_getSign($param, $key)
{
    $signPars = "";
    ksort($param);
    foreach ($param as $k => $v) {
        if ("sign" != $k && "" != $v) {
            $signPars .= $k . "=" . $v . "&";
        }
    }
    $signPars = trim($signPars, '&');
    $signPars .= $key;
    $sign = md5($signPars);
    return $sign;
}
function getServerIp(){
	$url = 'http://members.3322.org/dyndns/getip';
	$url2 = 'https://www.bt.cn/Api/getIpAddress';
	if($data = get_curl($url2)){
		return $data;
	}else{
		$data = get_curl($url);
		return $data;
	}
}
function checkIfActive($string) {
	$array=explode(',',$string);
	$php_self=substr($_SERVER['REQUEST_URI'],strrpos($_SERVER['REQUEST_URI'],'/')+1,strrpos($_SERVER['REQUEST_URI'],'.')-strrpos($_SERVER['REQUEST_URI'],'/')-1);
	if (in_array($php_self,$array)){
		return 'active';
	}elseif (isset($_GET['mod']) && in_array(str_replace('_n','',$_GET['mod']),$array)){
		return 'active';
	}else
		return null;
}
function checkRefererHost(){
	if(!$_SERVER['HTTP_REFERER'])return false;
	$url_arr = parse_url($_SERVER['HTTP_REFERER']);
	$http_host = $_SERVER['HTTP_HOST'];
	if(strpos($http_host,':'))$http_host = substr($http_host, 0, strpos($http_host, ':'));
	return $url_arr['host'] === $http_host;
}

function send_post($url, $post_data) {
  $postdata = http_build_query($post_data);
  $options = array(
    'http' => array(
      'method' => 'POST',
      'header' => 'Content-type:application/x-www-form-urlencoded',
      'content' => $postdata,
      'timeout' => 15 * 60 // 超时时间（单位:s）
    )
  );
  $context = stream_context_create($options);
  $result = file_get_contents($url, false, $context);
  return $result;
}

function ary_asd($mn_conf){
	$fh_ry='"';
	foreach($mn_conf as $sne=>$via){
		$fh_ry_r='"';
		if(is_array($via)){
			$via='array('.ary_asd($via).')';
			$fh_ry_r='';
		}
		if(is_numeric($via)){
			$fh_ry_r='';
		}
		if($kr_sxy==""){
			$kr_sxy.=$fh_ry.$sne.$fh_ry.'=>'.$fh_ry_r.$via.$fh_ry_r;
		} else{
			$kr_sxy.=','.$fh_ry.$sne.$fh_ry.'=>'.$fh_ry_r.$via.$fh_ry_r;
		}
	}
	return $kr_sxy;
}

class imgcompress{

    private $src;

    private $image;

    private $imageinfo;

    private $percent = 0.5;

    public function __construct($src, $percent=1)

    {

        $this->src = $src;

        $this->percent = $percent;

    }


    public function compressImg($saveName='')

    {

        $this->_openImage();

        if(!empty($saveName)) $this->_saveImage($saveName);  //保存

        else $this->_showImage();

    }

    private function _openImage()

    {

        list($width, $height, $type, $attr) = getimagesize($this->src);

        $this->imageinfo = array(

            'width'=>$width,

            'height'=>$height,

            'type'=>image_type_to_extension($type,false),

            'attr'=>$attr

        );

        $fun = "imagecreatefrom".$this->imageinfo['type'];

        $this->image = $fun($this->src);

        $this->_thumpImage();

    }

    private function _thumpImage()

    {

        $new_width = $this->imageinfo['width'] * $this->percent;

        $new_height = $this->imageinfo['height'] * $this->percent;

        $image_thump = imagecreatetruecolor($new_width,$new_height);

        //将原图复制带图片载体上面，并且按照一定比例压缩,极大的保持了清晰度

        imagecopyresampled($image_thump,$this->image,0,0,0,0,$new_width,$new_height,$this->imageinfo['width'],$this->imageinfo['height']);

        imagedestroy($this->image);

        $this->image = $image_thump;

    }

    /**

     * 输出图片:保存图片则用saveImage()

     */

    private function _showImage()

    {

        header('Content-Type: image/'.$this->imageinfo['type']);

        $funcs = "image".$this->imageinfo['type'];

        $funcs($this->image);

    }

    /**

     * 保存图片到硬盘：

     * @param  string $dstImgName  1、可指定字符串不带后缀的名称，使用源图扩展名 。2、直接指定目标图片名带扩展名。

     */

    private function _saveImage($dstImgName)

    {

        if(empty($dstImgName)) return false;

        $allowImgs = ['.jpg', '.jpeg', '.png', '.bmp', '.wbmp','.gif'];   //如果目标图片名有后缀就用目标图片扩展名 后缀，如果没有，则用源图的扩展名

        $dstExt =  strrchr($dstImgName ,".");

        $sourseExt = strrchr($this->src ,".");

        if(!empty($dstExt)) $dstExt =strtolower($dstExt);

        if(!empty($sourseExt)) $sourseExt =strtolower($sourseExt);

        //有指定目标名扩展名

        if(!empty($dstExt) && in_array($dstExt,$allowImgs)){

            $dstName = $dstImgName;

        }elseif(!empty($sourseExt) && in_array($sourseExt,$allowImgs)){

            $dstName = $dstImgName.$sourseExt;

        }else{

            $dstName = $dstImgName.$this->imageinfo['type'];

        }

        $funcs = "image".$this->imageinfo['type'];

        $funcs($this->image,$dstName);

    }

    /**

     * 销毁图片

     */

    public function __destruct(){

        imagedestroy($this->image);

    }

}

?>