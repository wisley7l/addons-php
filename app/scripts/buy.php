<?php
var_dump($_POST);
//echo "Test";
/*
  treat variables for purchase

  check login and if you are a shopkeeper.
  if not logged in, redirect to login screen (create login screen obs: moblie)
  if it is app create query for plans
  if it's thema create want to buy_theme
*/
$id_app = (int) $_POST['id'];
$price = (float) $_POST['value'];

if ((int) $_POST['is_app'] == 1) {
  echo "APP";
  echo PHP_EOL;
  echo $id_app;
  echo PHP_EOL;
  echo $price;
}else {
  echo "THEME";
  echo PHP_EOL;
  echo $id_app;
  echo PHP_EOL;
  echo $price;
}
