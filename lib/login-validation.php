<?php
// check is user, is store or partner and send information to section because the menus are different
//
if (!empty($_POST) AND (empty($_POST['username5']) OR empty($_POST['password5']))) {
      header("Location: index.php");
      exit;
  }
else {
    header("Location: test-server.php");
    exit;
}
