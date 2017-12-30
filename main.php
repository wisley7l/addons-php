<?php
/*
  THIS FILE MUST BE INCLUDED AT THE START OF ALL APP SCRIPTS
*/

// declare configuration constants
if (file_exists(__DIR__ . '/config/config.php')) {
  require __DIR__ . '/config/config.php';
} else {
  require __DIR__ . '/config/config-default.php';
}
