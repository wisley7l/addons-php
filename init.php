<?php
/*
  you must run this file once only, as root
  sudo php -f init.php
*/

function handle_mysql_error ($conn) {
  echo 'MySQL error: ';
  echo mysqli_error($conn);
  echo PHP_EOL;
  exit();
}

// declare configuration constants
if (file_exists(__DIR__ . '/config/config.php')) {
  $file = __DIR__ . '/config/config.php';
  require $file;
  // change config file permissions
  // read permission for file property and group only
  chmod($file, 0640);
  chgrp($file, Addons\APP_GROUP);
} else {
  require __DIR__ . '/config/config-default.php';
}

// create connection to the database
$conn = mysqli_connect(Addons\MYSQL_HOST, Addons\MYSQL_USER, Addons\MYSQL_PASS);
// check connection
if (mysqli_connect_errno()) {
  echo 'Connection failed: ';
  echo mysqli_connect_error();
  echo PHP_EOL;
  exit();
}

// create database in MariaDB
if (mysqli_query($conn, 'CREATE DATABASE IF NOT EXISTS ' . Addons\MYSQL_DB) === true) {
  echo 'MySQL database created';
  echo PHP_EOL;

} else {
  echo 'Failed to create database';
  echo PHP_EOL;
  handle_msyql_error($conn);
}


// update connection to the database
$conn = mysqli_connect(Addons\MYSQL_HOST, Addons\MYSQL_USER, Addons\MYSQL_PASS, Addons\MYSQL_DB);
// check connection
if (mysqli_connect_errno()) {
  echo 'Connection failed: ';
  echo mysqli_connect_error();
  echo PHP_EOL;
  exit();
}

// create tables
// read tables.sql file
$sql = file_get_contents(__DIR__ . '/sql/tables.sql');
if ($sql) {
  // http://php.net/manual/en/mysqli.multi-query.php
  if (mysqli_multi_query($conn, $sql)) {
    echo 'MySQL tables created';
    echo PHP_EOL;
    echo 'All done successfully, saying goodbye...';
    echo PHP_EOL;
  } else {
    echo 'Failed to create tables';
    echo PHP_EOL;
    handle_mysql_error($conn);
  }
}
// entering values in the category tables
// read categories.sql file
$query = file_get_contents(__DIR__ . '/sql/categories.sql');
if ($query) {
  // http://php.net/manual/en/mysqli.multi-query.php
  if (mysqli_multi_query($conn, $query)) {
    echo 'MySQL values entered';
    echo PHP_EOL;
    echo 'All done successfully, saying goodbye...';
    echo PHP_EOL;
  } else {
    echo 'Failed to insert values into table';
    echo PHP_EOL;
    handle_mysql_error($conn);
  }
}
