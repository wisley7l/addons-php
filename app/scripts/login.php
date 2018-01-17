<?php
// check if user and password are null, if null, redirect to index
if (!empty($_POST) AND (empty($_POST['user']) OR empty($_POST['pass']))){
  $Message = "Wisley OK";
  header("Location: ../index?EROORLOGIN");
  //exit;
}
// if they are not null, treat variables and query the database
else {
  $user = $_POST['user'];
  $pass = $_POST['pass'];
// query DB find user
}
