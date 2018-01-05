<?php

// functions to insert values into tables

// insert in the partners table
/*
`id` SMALLINT UNSIGNED NOT NULL,
`password` VARCHAR (12) NOT NULL,
`member_since` DATE NOT NULL,
`total_stars` INT UNSIGNED NOT NULL DEFAULT 0,
`number_stars` INT UNSIGNED NOT NULL DEFAULT 0,
`path_image` VARCHAR(255) NULL,
`profile_json` TEXT NULL,
*/
function insertPartners($conn, $id, $password, $member_since, $total_stars, $number_stars, $path_image, $profile_json)
{
    $sql = "INSERT INTO `partners` (`id`,`password`,`member_since`,`total_stars`,`number_stars`,`path_image`,`profile_json`)
            VALUES (${id},${password},${member_since},${total_stars},${number_stars},${path_image},${profile_json})";

    if (mysqli_query($conn, $sql)) {
        echo 'MySQL Insert Partner';
        echo PHP_EOL;
        echo 'Successfully Inserted Partner ...';
        echo PHP_EOL;
    } else {
        echo 'Failed to Insert Partner';
        echo PHP_EOL;
        mysqli_error($conn);
    }
}
/*
`id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
`partner_id` SMALLINT NOT NULL,
`title` VARCHAR(70) NOT NULL DEFAULT '',
`slug` VARCHAR(50) NOT NULL DEFAULT '',
`description` TEXT NULL,
`paid` TINYINT NOT NULL DEFAULT 0,
`version` VARCHAR(8) NOT NULL DEFAULT '1.0.0',
`version_date` DATE NULL,
`type` VARCHAR(14) NULL,
`module` CHAR(2) NULL,
`load_events` TEXT NULL,
`script_uri` VARCHAR(255) NULL,
`github_repository` VARCHAR(255),
`authentication` TINYINT NOT NULL DEFAULT 0,
`auth_callback_uri` VARCHAR(255),
`auth_scope` TEXT NULL,
`liked` INT NOT NULL DEFAULT 0,
`not_liked` INT NOT NULL DEFAULT 0,
`link_video` VARCHAR(255) NULL,
`plan_json` TEXT NULL,
`value_plan_basic` MEDIUMINT UNSIGNED NOT NULL DEFAULT 0,
*/
function insertApps($conn, $partner_id, $title, $slug, $description, $paid, $version, $version_date, $type, $module, $load_events, $script_uri, $github_repository, $authentication, $auth_callback_uri, $auth_scope, $liked, $not_liked, $link_video, $plan_json, $value_plan_basic)
{
    $sql = "INSERT INTO `applications` (`partner_id`, `title`,`slug`,`description`,`paid`,`version`,`version_date`, `type`, `module`,
      `load_events`, `script_uri`, `github_repository`,`authentication`,`auth_callback_uri`, `auth_scope`,`liked`,`not_liked`,
      `link_video`, `plan_json`, `value_plan_basic`) VALUES (${partner_id}, ${title}, ${slug}, ${description}, ${paid}, ${version},
      ${version_date}, ${type}, ${module},${load_events}, ${script_uri}, ${github_repository}, ${authentication},
      ${auth_callback_uri}, ${auth_scope}, ${liked},${not_liked}, ${link_video}, ${plan_json}, ${value_plan_basic} )";
    if (mysqli_query($conn, $sql)) {
        echo 'MySQL Insert Application';
        echo PHP_EOL;
        echo 'Successfully Inserted Application ...';
        echo PHP_EOL;
    } else {
        echo 'Failed to Insert Application';
        echo PHP_EOL;
        mysqli_error($conn);
    }
}
/*
`id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
`partner_id` SMALLINT NOT NULL,
`title` VARCHAR(70) NOT NULL DEFAULT '',
`slug` VARCHAR(50) NOT NULL DEFAULT '',
`description` TEXT NULL,
`paid` TINYINT NOT NULL DEFAULT 0,
`version` VARCHAR(8) NOT NULL DEFAULT '1.0.0',
`version_date` DATE NULL,
`liked` INT NOT NULL DEFAULT 0,
`not_liked` INT NOT NULL DEFAULT 0,
`link_video` VARCHAR(255) NULL,
`value_license_basic` MEDIUMINT UNSIGNED NOT NULL DEFAULT 0,
`value_license_extend` MEDIUMINT UNSIGNED NOT NULL DEFAULT 0,
*/
function insertThemes($conn, $partner_id, $title, $slug, $description, $paid, $version, $version_date, $liked, $not_liked, $link_video, $value_license_basic, $value_license_extend)
{
    $sql = "INSERT INTO `themes` (`partner_id`,`title`,`slug`,`description`,`paid`,`version`,`version_date`,`liked`,`not_liked`,`link_video`,`value_license_basic`,`value_license_extend`
      VALUES(${partner_id}, ${title}, ${slug}, ${description}, ${paid}, ${version}, ${version_date}, ${liked}, ${not_liked}, ${link_video}, ${value_license_basic}, ${value_license_extend})";
    if (mysqli_query($conn, $sql)) {
        echo 'MySQL Insert Theme';
        echo PHP_EOL;
        echo 'Successfully Inserted Theme ...';
        echo PHP_EOL;
    } else {
        echo 'Failed to Insert Theme';
        echo PHP_EOL;
        mysqli_error($conn);
    }
}
/*
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`app_id` MEDIUMINT NOT NULL,
`store_id` SMALLINT NOT NULL,
`date_init` DATE NOT NULL,
`date_end` DATE NOT NULL,
`date_renovation` DATE NOT NULL,
`type_plan` VARCHAR(15) NOT NULL DEFAULT 'trial',
`app_value` MEDIUMINT UNSIGNED NOT NULL DEFAULT 0,
`payment_status` VARCHAR(15) NOT NULL DEFAULT 'not_confirmed',
`plan_id` MEDIUMINT NULL,
`trasaction_code` VARCHAR(255) NULL,
*/
function insertPlans($conn, $app_id, $store_id, $date_init, $date_end, $date_renovation, $type_plan, $app_value, $payment_status, $plan_id, $trasaction_code)
{
    $sql = "INSERT INTO `plans` (`app_id`,`store_id`,`date_init`,`date_end`,`date_renovation`,`type_plan`,`app_value`,
      `payment_status`,`plan_id`,`trasaction_code`) VALUES(${app_id}, ${store_id}, ${date_init}, ${date_end}, ${date_renovation},
       ${type_plan}, ${app_value}, ${payment_status}, ${plan_id}, ${trasaction_code})";
    if (mysqli_query($conn, $sql)) {
        echo 'MySQL Insert Plan';
        echo PHP_EOL;
        echo 'Successfully Inserted Plan ...';
        echo PHP_EOL;
    } else {
        echo 'Failed to Insert Plan';
        echo PHP_EOL;
        mysqli_error($conn);
    }
}
/*
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`theme_id` MEDIUMINT NOT NULL,
`store_id` SMALLINT NOT NULL,
`date_init` DATE NOT NULL,
`date_end` DATE NULL,
`type_buy` VARCHAR(15) NOT NULL DEFAULT 'trial',
`theme_value` MEDIUMINT UNSIGNED NOT NULL DEFAULT 0,
`payment_status` VARCHAR(15) NOT NULL DEFAULT 'not_confirmed',
`license_id` TINYINT NULL,
`transaction_code` VARCHAR(255) NULL,
*/
function insertBuyThemes($conn, $theme_id, $store_id, $date_init, $date_end, $type_buy, $theme_value, $payment_status, $license_id, $transaction_code)
{
    $sql = "INSERT INTO `buy_thmes` (`theme_id`,`store_id`,`date_init`,`date_end`,`type_buy`,`theme_value`,`payment_status`,
      `license_id`,`transaction_code`) VALUES(${theme_id},${store_id},${date_init},${date_end},${type_buy},${theme_value},
      ${payment_status},${license_id},${transaction_code})";
    if (mysqli_query($conn, $sql)) {
        echo 'MySQL Insert Buy_theme';
        echo PHP_EOL;
        echo 'Successfully Inserted Buy_theme ...';
        echo PHP_EOL;
    } else {
        echo 'Failed to Insert Buy_theme';
        echo PHP_EOL;
        mysqli_error($conn);
    }
}
/*
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`store_id` SMALLINT NOT NULL,
`app_id` MEDIUMINT NOT NULL,
`date_comment` DATE NULL,
`comment` TEXT NOT NULL DEFAULT '',
*/

function insertComenntApp($conn, $store_id, $app_id, $date_comment, $comment)
{
    $sql = "INSERT INTO `comment_apps`(`store_id`,`app_id`,`date_comment`,`comment`) VALUES(${store_id},${app_id},${date_comment},${comment})";
    if (mysqli_query($conn, $sql)) {
        echo 'MySQL Insert Comment_app';
        echo PHP_EOL;
        echo 'Successfully Inserted Comment_app ...';
        echo PHP_EOL;
    } else {
        echo 'Failed to Insert Comment_app';
        echo PHP_EOL;
        mysqli_error($conn);
    }
}
/*
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`store_id` SMALLINT NOT NULL,
`theme_id` MEDIUMINT NOT NULL,
`date_comment` DATE NULL,
`comment` TEXT NOT NULL DEFAULT '',
*/
function insertComenntTheme($conn, $store_id, $theme_id, $date_comment, $comment)
{
    $sql = "INSERT INTO `comment_themes`(`store_id`,`theme_id`,`date_comment`,`comment`) VALUES(${store_id},${theme_id},${date_comment},${comment})";
    if (mysqli_query($conn, $sql)) {
        echo 'MySQL Insert Comment_theme';
        echo PHP_EOL;
        echo 'Successfully Inserted Comment_theme ...';
        echo PHP_EOL;
    } else {
        echo 'Failed to Insert Comment_theme';
        echo PHP_EOL;
        mysqli_error($conn);
    }
}
/*
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`store_id` SMALLINT NOT NULL,
`partner_id` SMALLINT NOT NULL,
`date_comment` DATE NULL,
`comment` TEXT NOT NULL DEFAULT '',
*/
function insertComenntPartners($conn, $store_id, $partner_id, $date_comment, $comment)
{
    $sql = "INSERT INTO `comment_partners`(`store_id`,`partner_id`,`date_comment`,`comment`) VALUES(${store_id},${partner_id},${date_comment},${comment})";
    if (mysqli_query($conn, $sql)) {
        echo 'MySQL Insert Comment_partner';
        echo PHP_EOL;
        echo 'Successfully Inserted Comment_partner ...';
        echo PHP_EOL;
    } else {
        echo 'Failed to Insert Comment_partner';
        echo PHP_EOL;
        mysqli_error($conn);
    }
}
/*
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`store_id` SMALLINT NOT NULL,
`partner_id` SMALLINT NOT NULL,
`date_msg` DATE NULL,
`msg` TEXT NOT NULL DEFAULT '',
*/

function insertInbox($conn, $store_id, $partner_id, $date_msg, $msg)
{
    $sql = "INSERT INTO `inbox`(`store_id`,`partner_id`,`date_msg`,`comment`) VALUES(${store_id},${partner_id},${date_msg},${msg})";
    if (mysqli_query($conn, $sql)) {
        echo 'MySQL Insert Inbox';
        echo PHP_EOL;
        echo 'Successfully Inserted Inbox ...';
        echo PHP_EOL;
    } else {
        echo 'Failed to Insert Inbox';
        echo PHP_EOL;
        mysqli_error($conn);
    }
}
/*
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`app_id` MEDIUMINT NOT NULL,
`name` VARCHAR(50) NULL,
`path_image` VARCHAR(255) NULL,,
*/
function insertImageApps($conn, $app_id, $name, $path_image)
{
    $sql = "INSERT INTO `image_apps`(`app_id`,`name`,`path_image`) VALUES(${app_id},${name},${path_image})";
    if (mysqli_query($conn, $sql)) {
        echo 'MySQL Insert Image_app';
        echo PHP_EOL;
        echo 'Successfully Inserted Image_app ...';
        echo PHP_EOL;
    } else {
        echo 'Failed to Insert Image_app';
        echo PHP_EOL;
        mysqli_error($conn);
    }
}
/*
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`theme_id` MEDIUMINT NOT NULL,
`name` VARCHAR(50) NULL,
`path_image` VARCHAR(255) NULL,,
*/
function insertImageTheme($conn, $app_id, $name, $path_image)
{
    $sql = "INSERT INTO `image_apps`(`theme_id`,`name`,`path_image`) VALUES(${theme_id},${name},${path_image})";
    if (mysqli_query($conn, $sql)) {
        echo 'MySQL Insert Image_theme';
        echo PHP_EOL;
        echo 'Successfully Inserted Image_theme ...';
        echo PHP_EOL;
    } else {
        echo 'Failed to Insert Image_theme';
        echo PHP_EOL;
        mysqli_error($conn);
    }
}
/*
`id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
`partner_id` SMALLINT NOT NULL,
`name` VARCHAR(15) NULL,
`path_image` VARCHAR(255) NOT NULL,
*/
function insertBadge($conn, $partner_id, $name, $path_image)
{
    $sql = "INSERT INTO `image_apps`(`partner_id`,`name`,`path_image`) VALUES(${partner_id},${name},${path_image})";
    if (mysqli_query($conn, $sql)) {
        echo 'MySQL Insert Image_theme';
        echo PHP_EOL;
        echo 'Successfully Inserted Image_theme ...';
        echo PHP_EOL;
    } else {
        echo 'Failed to Insert Image_theme';
        echo PHP_EOL;
        mysqli_error($conn);
    }
}

/*
`id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
`name` VARCHAR (20) NOT NULL DEFAULT '',
*/
function insertCategoryApps($conn, $name)
{
    $sql = "INSERT INTO `category_apps`(`name`) VALUES(${name})";
    if (mysqli_query($conn, $sql)) {
        echo 'MySQL Insert Category_apps';
        echo PHP_EOL;
        echo 'Successfully Inserted Category_apps ...';
        echo PHP_EOL;
    } else {
        echo 'Failed to Insert Category_apps';
        echo PHP_EOL;
        mysqli_error($conn);
    }
}
/*
`app_id` MEDIUMINT NOT NULL,
`category_apps_id` MEDIUMINT NOT NULL,
*/
function insertRelationshipCategoryApps($conn, $app_id, $category_apps_id)
{
    $sql = "INSERT INTO `relationship_category_apps`(`app_id`,`category_apps_id`) VALUES(${app_id},${category_apps_id})";
    if (mysqli_query($conn, $sql)) {
        echo 'MySQL Insert Relationship_category_apps';
        echo PHP_EOL;
        echo 'Successfully Inserted Relationship_category_apps ...';
        echo PHP_EOL;
    } else {
        echo 'Failed to Insert Relationship_category_apps';
        echo PHP_EOL;
        mysqli_error($conn);
    }
}

/*
`id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
`name` VARCHAR (20) NOT NULL DEFAULT '',
*/
function insertCategoryThemes($conn, $name)
{
    $sql = "INSERT INTO `category_themes`(`name`) VALUES(${name})";
    if (mysqli_query($conn, $sql)) {
        echo 'MySQL Insert Category_themes';
        echo PHP_EOL;
        echo 'Successfully Inserted Category_themes ...';
        echo PHP_EOL;
    } else {
        echo 'Failed to Insert Category_themes';
        echo PHP_EOL;
        mysqli_error($conn);
    }
}
/*
`theme_id` MEDIUMINT NOT NULL,
`category_themes_id` MEDIUMINT NOT NULL,
*/
function insertRelationshipCategoryThemes($conn, $theme_id, $category_themes_id)
{
    $sql = "INSERT INTO `relationship_category_themes`(`theme_id`,`category_themes_id`) VALUES(${theme_id},${category_themes_id})";
    if (mysqli_query($conn, $sql)) {
        echo 'MySQL Insert Relationship_category_themes';
        echo PHP_EOL;
        echo 'Successfully Inserted Relationship_category_themes ...';
        echo PHP_EOL;
    } else {
        echo 'Failed to Insert Relationship_category_themes';
        echo PHP_EOL;
        mysqli_error($conn);
    }
}
/*
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `store_id` SMALLINT UNSIGNED NULL,
  `app_id` MEDIUMINT UNSIGNED NULL,
  `transaction_code` VARCHAR(255) NULL,
  `notes` TEXT NULL,
  `payment_value` MEDIUMINT NOT NULL DEFAULT 0,
  `date_transaction` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
*/
function insertTransactionApps($conn, $store_id, $app_id, $transaction_code, $notes, $payment_value, $date_transaction)
{
    $sql = "INSERT INTO `transaction_apps`(`store_id`,`app_id`,`transaction_code`,`notes`,`payment_value`,`date_transaction`) VALUES(${store_id}, ${app_id}, ${transaction_code}, ${notes}, ${payment_value},${date_transaction})";
    if (mysqli_query($conn, $sql)) {
        echo 'MySQL Insert Transaction_apps';
        echo PHP_EOL;
        echo 'Successfully Inserted  Transaction_apps ...';
        echo PHP_EOL;
    } else {
        echo 'Failed to Insert Transaction_apps';
        echo PHP_EOL;
        mysqli_error($conn);
    }
}
/*
`id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
`store_id` SMALLINT UNSIGNED NULL,
`theme_id` MEDIUMINT UNSIGNED NULL,
`transaction_code` VARCHAR(255) NULL,
`notes` TEXT NULL,
`payment_value` MEDIUMINT NOT NULL DEFAULT 0,
`date_transaction` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
*/
function insertTransactionThemes($conn, $store_id, $theme_id, $transaction_code, $notes, $payment_value, $date_transaction)
{
    $sql = "INSERT INTO `transaction_themes`(`store_id`,`theme_id`,`transaction_code`,`notes`,`payment_value`,`date_transaction`) VALUES(${store_id}, ${app_id}, ${transaction_code}, ${notes}, ${payment_value},${date_transaction})";
    if (mysqli_query($conn, $sql)) {
        echo 'MySQL Insert Transaction_themes';
        echo PHP_EOL;
        echo 'Successfully Inserted  Transaction_themes ...';
        echo PHP_EOL;
    } else {
        echo 'Failed to Insert Transaction_themes';
        echo PHP_EOL;
        mysqli_error($conn);
    }
}
