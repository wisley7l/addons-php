<?php
// echo 'Hello World';
// echo PHP_EOL;
// test json
// $arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);
//
// $data = '{"Coords":[{"Accuracy":"65","Latitude":"53.277720488429026","Longitude":"-9.012038778269686","Timestamp":"Fri Jul 05 2013 11:59:34 GMT+0100 (IST)"},{"Accuracy":"65","Latitude":"53.277720488429026","Longitude":"-9.012038778269686","Timestamp":"Fri Jul 05 2013 11:59:34 GMT+0100 (IST)"},{"Accuracy":"65","Latitude":"53.27770755361785","Longitude":"-9.011979642121824","Timestamp":"Fri Jul 05 2013 12:02:09 GMT+0100 (IST)"},{"Accuracy":"65","Latitude":"53.27769091555766","Longitude":"-9.012051410095722","Timestamp":"Fri Jul 05 2013 12:02:17 GMT+0100 (IST)"},{"Accuracy":"65","Latitude":"53.27769091555766","Longitude":"-9.012051410095722","Timestamp":"Fri Jul 05 2013 12:02:17 GMT+0100 (IST)"}],"test":"certo","outro":"0"}';
//
// //echo json_encode($arr);
// //$data = json_encode($arr);
// $manage = json_decode($data,true);
//
// var_dump($manage);
//
// //echo $data;
// //echo $manage['a'];

// // Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
// $ch = curl_init();
//
// curl_setopt($ch, CURLOPT_URL, "https://market.e-com.plus/scripts/login");
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// curl_setopt($ch, CURLOPT_POSTFIELDS, "user=we7l%40yahoo.com.br&pass=123456");
// curl_setopt($ch, CURLOPT_POST, 1);
//
// $headers = array();
// $headers[] = "Content-Type: application/x-www-form-urlencoded";
// curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
// $result = curl_exec($ch);
//
// header("Location: ../");
// exit;
// $number = 101;
// $string = strval ($number);
// $eh_aqui = strlen ( $string ) - 2;
// echo $eh_aqui;
// $plan_basic = number_format($number, 2, '', '');
// echo $plan_basic;
// $antes = substr($string, 0, $eh_aqui);
//
// $depois = substr($string, $eh_aqui);
//
// $string = $antes . "." . $depois;
//
//
// echo (float) $string;

$apps = search_all_apps(24); // return a maximum of 25 apps in the search
// var_dump($apps);
