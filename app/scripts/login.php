<?php
// check if user and password are null, if null, redirect to index
if (!empty($_POST) AND (empty($_POST['user']) OR empty($_POST['pass']))){
  header("Location: ../?EROORLOGIN");
  exit;
}
// if they are not null, treat variables and query the database
else {
  $user = $_POST['user'];
  $pass = $_POST['pass'];
// query DB find user
  if (!isset($_SESSION)){
    session_id(1);
    session_start();
    $_SESSION['user_id'] = 1;
    $_SESSION['user_name'] = $user;
    $_SESSION['login'] = true;
    //var_dump($_SESSION);
    if (!is_writable(session_save_path())) {
    echo 'Session path "'.session_save_path().'" is not writable for PHP!';
    }
    else {
      echo "YESSSS";
    }
  }

  //header("Location: ../?SUCESSLOGIN");
  //exit;
}
