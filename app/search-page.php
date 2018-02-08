<?php
var_dump($_GET);

if (empty($_GET['term'])) {
   //Term is empty
  echo "error";
}else if (empty($_GET['app'])){
  // app is empty
  echo "error";
} else if ((int) $_GET['app'] == 1) {
  // app is 1
  # seacrh app
  echo "app";
}else if ((int) $_GET['app'] == 0) {
  // app is 0
  # search theme
  echo "theme";
} elseif (!empty($_GET['term'])) {
  # code...
  echo "term";
}
