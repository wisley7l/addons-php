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

// create connection to the database
$conn = mysqli_connect(Addon\MYSQL_HOST, Addon\MYSQL_USER, Addons\MYSQL_PASS);
//check connection
if (!$conn) {
    die('Connection failed: '.mysqli_connect_error());
}
// create database in MariaDB
$sql = 'CREATE DATABASE IF NOT EXISTS'.Addons\MYSQL_DB;
// create tables
// TABLE PARTNERS
$sql1 = "CREATE TABLE IF NOT EXISTS `partners` (
  `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NULL,
  `public_contact` VARCHAR(255) NULL,
  `about_us` TEXT NULL,
  `email` VARCHAR(255) NOT NULL DEFAULT '',
  `revenue_share` TINYINT NOT NULL DEFAULT 10,
  `contact_name` VARCHAR(255) NULL,
  `doc_type` VARCHAR(20) NOT NULL DEFAULT '',
  `doc_number` BIGINT UNSIGNED ZEROFILL NOT NULL DEFAULT 0,
  `inscription_type` VARCHAR(20) NULL,
  `inscription_number` VARCHAR(50) NULL,
  `corporate_name` VARCHAR(255) NOT NULL DEFAULT '',
  `address` VARCHAR(255) NULL,
  `phone` BIGINT UNSIGNED NULL,
  `password` VARCHAR (12) NOT NULL,
  `member_since` DATE NOT NULL,
  `total_stars` INT UNSIGNED NOT NULL DEFAULT 0,
  `number_stars` INT UNSIGNED NOT NULL DEFAULT 0,
  `path_image` VARCHAR(255) NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1"
// TABLE APPS
$sql2 = "CREATE TABLE IF NOT EXISTS `applications`(
  `id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `partner_id` SMALLINT NOT NULL,
  `about_us` TEXT NULL,
  `title` VARCHAR(70) NULL,
  `slug` VARCHAR(50) NOT NULL DEFAULT '',
  `paid` BOOLEAN NOT NULL DEFAULT FALSE,
  `version` VARCHAR(8) NOT NULL DEFAULT '',
  `version_date` DATETIME,
  `type` VARCHAR(14) NULL,
  `module` VARCHAR(2) NULL,
  `load_events` JSON,
  `script_uri` VARCHAR(255) NOT NULL DEFAULT '',
  `github_repository` VARCHAR(255),
  `authentication` BOOLEAN NOT NULL DEFAULT FALSE,
  `auth_callback_uri` VARCHAR(255),
  `auth_scope` JSON,
  `liked` INT NOT NULL DEFAULT 0,
  `not_liked`INT NOT NULL DEFAULT 0,
  PRIMARY KEY(`id`),
  FOREIGN KEY (`partner_id`) REFERENCES `partners`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1000"
// TABLE  THEMES
$sql3 = "CREATE TABLE IF NOT EXISTS `themes`(
  `id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `partner_id` SMALLINT NOT NULL,
  `about_us` TEXT NULL,
  `title` VARCHAR(70),
  `slug` VARCHAR(50),
  `paid` BOOLEAN NOT NULL DEFAULT FALSE,
  `version` VARCHAR(8),
  `version_date` DATETIME
  `liked` INT NOT NULL DEFAULT 0,
  `not_liked`INT NOT NULL DEFAULT 0,
  PRIMARY KEY(`id`),
  FOREIGN KEY (`partner_id`) REFERENCES `partners`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
  )ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1000"
//TABLE PLANE
// ex. type = trial
$sql4 = "CREATE TABLE IF NOT EXISTS `plane`(
    `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
    `app_id` SMALLINT NOT NULL,
    `store_id` SMALLINT NOT NULL,
    `date_init` DATETIME NOT NULL,
    `date_end` DATETIME NOT NULL,
    `type` VARCHAR(50) NOT NULL,
    `app_value` DECIMAL(5,2) UNSIGNED NOT NULL,
    `payment_status` VARCHAR(15) NOT NULL,
    PRIMARY KEY(`id`),
    FOREIGN KEY (`app_id`) REFERENCES `applications`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1 "
// TABLE BUY_THEME
// ex. type = trial
$sql5 = "CREATE TABLE IF NOT EXISTS `buy_theme(
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `theme_id` SMALLINT NOT NULL,
  `store_id` SMALLINT NOT NULL,
  `date_init` DATETIME NOT NULL,
  `date_end` DATETIME NOT NULL,
  `type` VARCHAR(50) NOT NULL,
  `theme_value` DECIMAL(5,2) UNSIGNED NOT NULL,
  `payment_status` VARCHAR(15) NOT NULL,
  PRIMARY KEY(`id`),
  FOREIGN KEY (`theme_id`) REFERENCES `themes`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
)`"
// TABLE OF RELATIONSHIP OF STORES WITH COMMENTS ON APPS
$sql6 = "CREATE TABLE IF NOT EXISTS `comments_apps`(
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `store_id` SMALLINT NOT NULL,
  `app_id` SMALLINT NOT NULL,
  `date_comment` DATETIME,
  `comment` TEXT NOT NULL,
  PRIMARY KEY(`id`),
  FOREIGN KEY(`app_id`) REFERENCES `applications` ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`store_id`) REFERENCES `store` ON DELETE SET NULL ON UPDADTE CASCADE
)ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1"
// TABLE OF RELATIONSHIP OF STORES WITH COMMENTS ON THEME
$sql7 = "CREATE TABLE IF NOT EXISTS `comments_themes`(
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `store_id` SMALLINT NOT NULL,
  `theme_id` SMALLINT NOT NULL,
  `date_comment` DATETIME NOT NULL,
  `comment` TEXT NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`theme_id`) REFERENCES `themes` ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`store_id`) REFERENCES `store` ON DELETE SET NULL ON UPDADTE CASCADE
)ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1"
//TABLE OF RELATIONSHIP OF STORES WITH COMMENTS ON PARTNERS
$sql8 = "CREATE TABLE IF NOT EXISTS `comments_themes`(
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `store_id` SMALLINT NOT NULL,
  `theme_id` SMALLINT NOT NULL,
  `date_comment` DATETIME NOT NULL,
  `comment` TEXT NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`theme_id`) REFERENCES `themes` ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`store_id`) REFERENCES `store` ON DELETE SET NULL ON UPDADTE CASCADE
)ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1"
// TABLE INBOX
$sql9 = "CREATE TABLE IF NOT EXISTS `inbox` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `partner_id` SMALLINT NOT NULL,
  `store_id` SMALLINT NOT NULL,
  `date_msg` DATETIME NOT NULL,
  `message` TEXT NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`partner_id`) REFERENCES `partners` ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`store_id`) REFERENCES `store` ON DELETE SET NULL ON UPDADTE CASCADE
)ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1"
// TABLE IMAGE OF THE APPS
$sql10 = "CREATE TABLE IF NOT EXISTS `image_apps`(
  `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NULL,
  `app_id` SMALLINT NOT NULL,
  `path_image` VARCHAR(255) NULL,
  `link_video` VARCHAR(255) NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`app_id`) REFERENCES `applications` ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1"
// TABLE IMAGE OF THE THEMES
$sql11 = "CREATE TABLE IF NOT EXISTS `image_themes`(
  `id` TINYINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(50) NULL,
  `theme_id` SMALLINT NOT NULL,
  `path_image` VARCHAR(255) NULL,
  `link_video` VARCHAR(255) NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`theme_id`) REFERENCES `themes` ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1"
// TABLE STORE
$sql12 = "CREATE TABLE IF NOT EXISTS `store`(
  `id` SMALLINT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
)ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci"
// add table in array
$querys = [$sql,$sql1,$sql2,$sql3,$sql4,$sql5,$sql6,$sql7,$sql8,$sql9,$sql10,$sql11,$sql12];
// foreach table execute an query
foreach($querys as $k => $sql){
    //execute querry
    $query = mysqli_query($conn, $sql);
    // if querry failed add error in array
    if(!$query)
       $message[] = $k.' : Creation failed ('.mysqli_error ($conn).')';
    else
       $message[] = $k.' : Creation sucess';
}
foreach($message as $msg) {
  // print message
   echo "$msg <br>";
}
// close connection
mysqli_close($conn);
