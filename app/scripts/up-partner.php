<?php
header('Content-Type: text/html; charset=utf-8');
echo PHP_EOL;
var_dump($_POST);
echo PHP_EOL;
var_dump($_FILES);
// check if the (id) logged is equal to or (id) sent
$id = (int) $_POST['id'];

// save profile image with user id name
if (empty($_POST)) {
  header("Location: index");
  exit;
}
