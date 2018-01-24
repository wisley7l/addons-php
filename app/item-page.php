<?php
if (isset($_GET['id']) AND isset($_GET['app'])){
  echo $_GET['id'];
  echo PHP_EOL;
  echo $_GET['app'];
}
else {
  # code...
}
