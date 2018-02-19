<?php
echo "page create password";
if (empty([$_GET])) {
  # error redirect index
  header("Location: index");
  exit;
}elseif (!empty($_GET['id'])) {
  $id = (int)$_GET['id'];
  echo PHP_EOL;
  echo "$id";
}
