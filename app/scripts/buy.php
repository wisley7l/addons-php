<?php
//var_dump($_POST);
//echo "Test";
/*
  treat variables for purchase

  check login and if you are a shopkeeper.
  if not logged in, redirect to login screen (create login screen obs: moblie)
  if it is app create query for plans
  if it's thema create want to buy_theme
*/
if ($_POST['is_app']) {
  echo "app";
}
