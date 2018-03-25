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
  if ($result = mysqli_multi_query($conn, $sql)) {
    echo 'MySQL tables created';
    echo PHP_EOL;
    echo 'All done successfully, saying goodbye...';
    echo PHP_EOL;
    // free result set
    mysqli_free_result($result);
  } else {
    echo 'Failed to create tables';
    echo PHP_EOL;
    handle_mysql_error($conn);
  }
}

// entering values in the category tables
// read categories.sql file
$query = array();
//array_push($query, 'INSERT INTO category_apps (name) VALUES ("product_sourcing");');
array_push($query, 'INSERT INTO category_apps (name) VALUES ("marketing");');
array_push($query, 'INSERT INTO category_apps (name) VALUES ("sales");');
array_push($query, 'INSERT INTO category_apps (name) VALUES ("social_media");');
array_push($query, 'INSERT INTO category_apps (name) VALUES ("shipping");');
array_push($query, 'INSERT INTO category_apps (name) VALUES ("inventory");');
array_push($query, 'INSERT INTO category_apps (name) VALUES ("customer_service");');
array_push($query, 'INSERT INTO category_apps (name) VALUES ("tools");');
array_push($query, 'INSERT INTO category_apps (name) VALUES ("reporting");');
array_push($query, 'INSERT INTO category_apps (name) VALUES ("sales_channels");');
array_push($query, 'INSERT INTO category_themes (name) VALUES ("art_photography");');
array_push($query, 'INSERT INTO category_themes (name) VALUES ("clothing_fashion");');
array_push($query, 'INSERT INTO category_themes (name) VALUES ("jewelry_accessories");');
array_push($query, 'INSERT INTO category_themes (name) VALUES ("electronics");');
array_push($query, 'INSERT INTO category_themes (name) VALUES ("food_drinks");');
array_push($query, 'INSERT INTO category_themes (name) VALUES ("home_garden");');
array_push($query, 'INSERT INTO category_themes (name) VALUES ("furniture");');
array_push($query, 'INSERT INTO category_themes (name) VALUES ("health_beauty");');
array_push($query, 'INSERT INTO category_themes (name) VALUES ("sports_recreation");');
array_push($query, 'INSERT INTO category_themes (name) VALUES ("toys_games");');
array_push($query, 'INSERT INTO category_themes (name) VALUES ("games");');
array_push($query, 'INSERT INTO category_themes (name) VALUES ("sexshop");');
array_push($query, 'INSERT INTO category_themes (name) VALUES ("petshop");');
array_push($query, 'INSERT INTO category_themes (name) VALUES ("service");');
array_push($query, 'INSERT INTO category_themes (name) VALUES ("fitness");');
array_push($query, 'INSERT INTO category_themes (name) VALUES ("other");');

for ($i=0; $i <count($query) ; $i++) {
  if ($query) {
    // http://php.net/manual/en/mysqli.multi-query.php
    if ($result = mysqli_query($conn, $query)) {
      echo 'MySQL values entered';
      echo PHP_EOL;
      echo 'All done successfully, saying goodbye...';
      echo PHP_EOL;
      mysqli_free_result($result);
    } else {
      echo 'Failed to insert values into table ' ;
      echo $i;
      echo PHP_EOL;
      handle_mysql_error($conn);
    }
  }
}
