<?php
echo "page create password";
if (!empty($_GET['id'])) {
  $id = (int)$_GET['id'];
  echo PHP_EOL;
  echo "$id";
}else {
  # error redirect index
  header("Location: index");
  exit;
}
