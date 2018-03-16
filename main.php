<?php
function page_404 () {
  http_response_code(404);
  // @TODO: 404 html page
  exit();
}

// check server params
if (!isset($_SERVER['PATH_FILE']) || !isset($_SERVER['PATH_LANG'])) {
  http_response_code(500);
  echo 'Web server must set PATH_FILE and PATH_LANG';
  echo PHP_EOL;
  echo 'RegEx pattern to URI: ^\/(?<path_lang>[a-z]{2}_[a-z]{2})\/(?<path_file>[^.]+)$';
  echo PHP_EOL;
  echo 'Eg.: /pt_br/index';
  echo PHP_EOL;
  echo '$_SERVER[\'PATH_LANG\'] = \'pt_br\';';
  echo PHP_EOL;
  echo '$_SERVER[\'PATH_FILE\'] = \'index\';';
  echo PHP_EOL;
  exit();
}

// available languages
switch ($_SERVER['PATH_LANG']) {
  case 'pt_br':
  case 'en_us':
    // continue
    break;

  default:
    // no support
    page_404();
    break;
}

// check URL filename
if ($_SERVER['PATH_FILE'] != null) {
  $filename = __DIR__ . '/app/' . $_SERVER['PATH_FILE'] . '.php';
  if (!file_exists($filename)) {
    page_404();
  }
} else {
  $filename = __DIR__ . '/app/index.php';
}

// declare configuration constants
if (file_exists(__DIR__ . '/config/config.php')) {
  require __DIR__ . '/config/config.php';
} else {
  require __DIR__ . '/config/config-default.php';
}
// define path to sessions
ini_set(session_save_path(realpath(dirname('/tmp/sessions/'))));
// load composer packages
require __DIR__ . '/composer/vendor/autoload.php';
// load dictionary
require __DIR__ . '/lib/dictionary.php';
// load categories
require __DIR__ . '/lib/categories.php';
//load test query php
require __DIR__ . '/lib/test-user.php';
//
require __DIR__ . '/lib/querys_functions.php';
// app script
require $filename;
