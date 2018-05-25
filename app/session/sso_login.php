<?php
var_dump($_GET);
$sso = urldecode($_GET['sso']);
$sig = $_GET['sig'];
//
$sso_decode = base64_decode($sso);
echo PHP_EOL;
echo $sso;
echo PHP_EOL;
echo $sso_decode;
parse_str($sso_decode,$q);
echo PHP_EOL;
var_dump($q);
