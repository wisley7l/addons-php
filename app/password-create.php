<?php
echo "page create password";
if (isset($_GET)) {
  # error redirect index
  header("Location: index");
  exit;
}elseif (!empty($_GET['id'])) {
  $id = (int)$_GET['id'];
  echo PHP_EOL;
  echo "$id";
}else if (empty($_GET['id'])){
  echo "simmm";
}
