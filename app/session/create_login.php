<?php

$nonce = uniqid(rand(), true);
// echo $nonce;
// echo PHP_EOL;
setcookie ( "nonce", $nonce, 0 , "/");
// echo $nonce;
// echo PHP_EOL;
$str_nonce = "nonce=" . $nonce;
// echo $str_nonce;
// echo PHP_EOL;
$paylod = base64_encode($str_nonce);
// echo $paylod;
// echo PHP_EOL;
$url_paylod = urlencode($paylod);
// echo $url_paylod;
// echo PHP_EOL;
$sha256 = hash_hmac('sha256',$paylod,Addons\SSO_SECRET);
// echo $sha256;
// echo PHP_EOL;
// https://admin.e-com.plus/session/sso/v1/market
header("Location: https://admin.e-com.plus/session/sso/v1/market?sso=$url_paylod&sig=$sha256");
// exit();
//*/
