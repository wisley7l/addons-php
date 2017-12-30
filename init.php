<?php
/*
  you must run this file once only, as root
  sudo php -f init.php
*/

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

// TODO: create MySQL database and tables if not exists
