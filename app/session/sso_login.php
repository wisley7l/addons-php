<?php
// var_dump($_GET);
$sso = urldecode($_GET['sso']);
$sig = $_GET['sig'];
$sso_decode = base64_decode($sso);
// echo PHP_EOL;
// echo $sso;
// echo PHP_EOL;
// echo $sso_decode;
setcookie ( "nonce");
parse_str($sso_decode,$query);
// echo PHP_EOL;
// var_dump($q);
// ["nonce"]=>
//   string(33) "19266332085b0613fb1cb788.76724176"
//   ["name"]=>
//   string(10) "Team E-Com"
//   ["external_id"]=>
//   string(1) "1"
//   ["email"]=>
//   string(18) "contato@e-com.club"
//   ["username"]=>
//   string(4) "team"
//   ["custom_locale"]=>
//   string(5) "pt_br"
//   ["custom_edit_storefront"]=>
//   string(4) "true"
//   ["custom_store_id"]=>
//   string(1) "1"
//   ["require_activation"]=>
//   string(4) "true"
echo PHP_EOL;
echo $_COOKIE['nonce'];
// echo PHP_EOL;
// echo $query['nonce'];
