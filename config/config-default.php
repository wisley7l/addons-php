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
  case 'en_us':
    define('Addons\MKTP_SUBTITLE', 'Ecommerce apps and themes marketplace');
    define('Addons\MKTP_DESC_FOOTER','is the best e-commerce theme and app marketplace designed to enable retailers who do not have large investment capacity to access a customized quality layout at the best price.');
    break;

  default:
    define('Addons\MKTP_SUBTITLE', 'Marketplace de apps e temas para e-commerce');
    define('Addons\MKTP_DESC_FOOTER','é o melhor marketplace de apps e temas para e-commerce, criado para possibilitar que lojistas que não tem grande capacidade de investimento tenham acesso a um layout personalizado de qualidade pelo melhor preço.');
    break;
}
