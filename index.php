<p>欢迎来自
<?php
function GetIpCity() {
$realip = '';
$unknown = 'unknown';
if (isset($_SERVER)) {
if (isset($_SERVER['HTTP_X_FORWARDED_FOR']) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']) && strcasecmp($_SERVER['HTTP_X_FORWARDED_FOR'], $unknown)) {
$arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
foreach ($arr as $ip) {
$ip = trim($ip);
if ($ip != 'unknown') {
$realip = $ip;
break;
}
}
} else if (isset($_SERVER['HTTP_CLIENT_IP']) && !empty($_SERVER['HTTP_CLIENT_IP']) && strcasecmp($_SERVER['HTTP_CLIENT_IP'], $unknown)) {
$realip = $_SERVER['HTTP_CLIENT_IP'];
} else if (isset($_SERVER['REMOTE_ADDR']) && !empty($_SERVER['REMOTE_ADDR']) && strcasecmp($_SERVER['REMOTE_ADDR'], $unknown)) {
$realip = $_SERVER['REMOTE_ADDR'];
} else {
$realip = $unknown;
}
} else {
if (getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), $unknown)) {
$realip = getenv("HTTP_X_FORWARDED_FOR");
} else if (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), $unknown)) {
$realip = getenv("HTTP_CLIENT_IP");
} else if (getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), $unknown)) {
$realip = getenv("REMOTE_ADDR");
} else {
$realip = $unknown;
}
}
$realip = preg_match("/[\d\.]{7,15}/", $realip, $matches) ? $matches[0] : $unknown;

//淘宝ip接口
$res = @file_get_contents('http://ip.taobao.com/service/getIpInfo.php?ip=' . $realip);
if (empty($res)) {
return false;
}
$json = json_decode($res, true);
return $json['data']['country'].$json['data']['region'].'省'.$json['data']['city'].'市'.$json['data']['isp'];
}
echo GetIpCity();
?>

的访客!
</p>