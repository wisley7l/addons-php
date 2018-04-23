<?php
// get infomations in client
// consult the database if the user already exists, if there is information and
// initiate session, if it does not exist, merge into the database and initialize
//session

//createSession($id,$email,$name,$credits,$image,$is_store)
$conn = connect_db();

$query = "SELECT id, credits FROM store  WHERE id = $id LIMIT 1;";


if ($result = mysqli_query(  $conn, $query )) {
  // fetch associative array
  while ($row = mysqli_fetch_assoc($result)) {
    $id = $row['id'];
    $credit = $row['credits'];
  }
  // free result set
  mysqli_free_result($result);
}

  if ($id == NULL OR $id == '' ) {
    //create user
  }else {
    //createSession(1,'NO-Email','SHOPMAN-TEST',0,NULL,1);    
  }
