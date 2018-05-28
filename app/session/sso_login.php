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
parse_str($sso_decode,$query_s);
if ($_COOKIE['nonce'] != $query_s['nonce']) {
  header("Location: ../#errorLogin");
  exit();
}
// echo PHP_EOL;
// var_dump($query);
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
// echo PHP_EOL;
// echo $_COOKIE['nonce'];
// echo PHP_EOL;
// echo $query['nonce'];
// echo PHP_EOL;
// echo $query['email'];
// echo PHP_EOL;
// echo $query['name'];


// get infomations in client
// consult the database if the user already exists, if there is information and
// initiate session, if it does not exist, merge into the database and initialize
//session

//createSession($id,$email,$name,$credits,$image,$is_store)
// /*
$conn = connect_db();
$id_store = (int) $query_s['external_id'];


$query = "SELECT store_id, credits FROM store  WHERE store_id = $id_store LIMIT 1;";


if ($result = mysqli_query(  $conn, $query )) {
  // fetch associative array
  while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['store_id'];
    $credit = $row['credits'];
  }
  // free result set
  mysqli_free_result($result);
}

//*
if ($id == NULL OR $id == '' ) {
  //create user
  $query =  "INSERT INTO `store` (`store_id`, `credits`) VALUES ($id_store,0);";
  if (!mysqli_query($conn, $query)) {
    // error INSERT // redirect
    header("Location: ../#ERRORCreateUser");
    exit();
  }
  else {
      createSession($id_store,$query_s['email'],"teste",0,NULL,1);
  }
}else {
  createSession($id,$query_s['email'],"teste2",$credit,NULL,1);
}
//*/
