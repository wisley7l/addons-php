<?php
var_dump($_GET);
$sso = urldecode($_GET['sso']);
$sig = $_GET['sig'];
//base64_decode
echo PHP_EOL;
echo $sso;
