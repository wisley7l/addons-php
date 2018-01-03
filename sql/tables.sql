CREATE TABLE IF NOT EXISTS `partners` (
  `id` SMALLINT UNSIGNED NOT NULL,
  `password` VARCHAR (12) NOT NULL,
  `member_since` DATE NOT NULL,
  `total_stars` INT UNSIGNED NOT NULL DEFAULT 0,
  `number_stars` INT UNSIGNED NOT NULL DEFAULT 0,
  `path_image` VARCHAR(255) NULL,
  `profile_json` TEXT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `applications` (
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
  PRIMARY KEY (`id`),
  FOREIGN KEY (`partner_id`) REFERENCES `partners`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1000;
