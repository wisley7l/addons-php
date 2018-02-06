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
$id_app = (int) $_POST['id_app'];
$price = (float) $_POST['value'];

if ((int) $_POST['is_app'] == 1) {
  // mount query for app purchase
  echo "APP";
  echo PHP_EOL;
  echo $id_app;
  echo PHP_EOL;
  echo $price;
  echo PHP_EOL;
}else {
  $id_template = (int) $_POST['id_template'];
  // mount query for theme purchase
  echo "THEME";
  echo PHP_EOL;
  echo $id_app;
  echo PHP_EOL;
  echo $price;
  echo PHP_EOL;
  $id_template = (int) $_POST['id_template'];
  echo $id_template;
}
