<?php
namespace Addons;

// path to app root
const PATH_APP = '/var/www/addons-php';
// path to store app data
// user that is running PHP scripts must have permissions to write at this directory
const PATH_DATA = '/var/www/data';

// user and group running PHP scripts
// const APP_USER = 'apache';
const APP_GROUP = 'apache';

// MySQL server credentials
const MYSQL_HOST = 'localhost';
const MYSQL_USER = 'addons';
// place MySQL user password here
const MYSQL_PASS = '';
const MYSQL_DB = 'ecomplus_addons';

// Marketplace configuration
const MKTP_TITLE = 'E-Com Plus Addons';

switch ($_SERVER['PATH_LANG']) {
  case 'pt_br':
    define('Addons\MKTP_SUBTITLE', 'Marketplace de apps e temas para e-commerce');
    break;

  default:
    define('Addons\MKTP_SUBTITLE', 'Ecommerce apps and themes marketplace');
    break;
}
