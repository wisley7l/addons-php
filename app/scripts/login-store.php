<?php
// get infomations in client
// consult the database if the user already exists, if there is information and
// initiate session, if it does not exist, merge into the database and initialize
//session

//createSession($id,$email,$name,$credits,$image,$is_store)
/*
$conn = connect_db();
$id_store = (int) 1;

$query = "SELECT store_id, credits FROM store  WHERE id = $id_store LIMIT 1;";


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
      createSession($id_store,'NO-Email','SHOPMAN-TEST',0,NULL,1);
  }
}else {
  createSession($id,'NO-Email','SHOPMAN-TEST',$credit,NULL,1);
}
//*/
//*
$nonce = uniqid(rand(), true);
$_COOKIE['nonce'] = $nonce;
echo PHP_EOL;
echo $_COOKIE['nonce'];
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
// header("Location: https://admin.e-com.plus/session/sso/v1/market?sso=$url_paylod&sig=$sha256");
// exit();
//*/
