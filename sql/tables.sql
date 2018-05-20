CREATE TABLE IF NOT EXISTS `partners` (
  `id` SMALLINT UNSIGNED NOT NULL,
  `password_hash` VARCHAR (255) NULL,
  `member_since` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `avg_stars` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  `evaluations` SMALLINT UNSIGNED NOT NULL DEFAULT 0,
  `path_image` VARCHAR(255) NULL,
  `profile_json` TEXT NULL,
  `credit` MEDIUMINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX (`id`)
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `partners_evaluations` (
  `partner_id` SMALLINT UNSIGNED NOT NULL,
  `store_id` MEDIUMINT UNSIGNED NOT NULL,
  `date_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `stars` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`partner_id`, `store_id`),
  FOREIGN KEY (`partner_id`) REFERENCES `partners`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `apps` (
  `id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `partner_id` SMALLINT UNSIGNED NOT NULL,
  `title` VARCHAR(70) NOT NULL DEFAULT '',
  `slug` VARCHAR(70) NOT NULL DEFAULT '',
  `thumbnail` VARCHAR(255) NULL,
  `description` TEXT NULL,
  `json_body` TEXT NULL,
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
  `avg_stars` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  `evaluations` SMALLINT UNSIGNED NOT NULL DEFAULT 0,
  `website` VARCHAR(255) NULL,
  `link_video` VARCHAR(255) NULL,
  `plans_json` TEXT NULL,
  `value_plan_basic` MEDIUMINT UNSIGNED NOT NULL DEFAULT 0,
  `active` TINYINT NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  INDEX (`partner_id`, `slug`),
  FOREIGN KEY (`partner_id`) REFERENCES `partners`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1000;

CREATE TABLE IF NOT EXISTS `apps_evaluations` (
  `app_id` MEDIUMINT UNSIGNED NOT NULL,
  `store_id` MEDIUMINT UNSIGNED NOT NULL,
  `date_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `stars` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`app_id`, `store_id`),
  FOREIGN KEY (`app_id`) REFERENCES `apps`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `themes` (
  `id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `partner_id` SMALLINT UNSIGNED NOT NULL,
  `title` VARCHAR(70) NOT NULL DEFAULT '',
  `slug` VARCHAR(50) NOT NULL DEFAULT '',
  `thumbnail` VARCHAR(255) NULL,
  `description` TEXT NULL,
  `json_body` TEXT NULL,
  `paid` TINYINT NOT NULL DEFAULT 0,
  `version` VARCHAR(8) NOT NULL DEFAULT '1.0.0',
  `version_date` DATE NULL,
  `avg_stars` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  `evaluations` SMALLINT UNSIGNED NOT NULL DEFAULT 0,
  `link_documentation` VARCHAR(255) NULL,
  `link_video` VARCHAR(255) NULL,
  `value_license_basic` MEDIUMINT UNSIGNED NOT NULL DEFAULT 0,
  `value_license_extend` MEDIUMINT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX (`partner_id`, `slug`),
  FOREIGN KEY (`partner_id`) REFERENCES `partners`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1000;

CREATE TABLE IF NOT EXISTS `themes_evaluations` (
  `theme_id` MEDIUMINT UNSIGNED NOT NULL,
  `store_id` MEDIUMINT UNSIGNED NOT NULL,
  `date_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `stars` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`theme_id`, `store_id`),
  FOREIGN KEY (`theme_id`) REFERENCES `themes`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `comment_apps` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `store_id` MEDIUMINT UNSIGNED NULL,
  `app_id` MEDIUMINT UNSIGNED NOT NULL,
  `date_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment` TEXT NOT NULL DEFAULT '',
  `parent_comment_id` INT UNSIGNED NULL,
  PRIMARY KEY (`id`),
  INDEX (`app_id`),
  FOREIGN KEY (`app_id`) REFERENCES `apps`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`parent_comment_id`) REFERENCES `comment_apps`(`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `comment_themes` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `store_id` MEDIUMINT UNSIGNED NULL,
  `theme_id` MEDIUMINT UNSIGNED NOT NULL,
  `date_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment` TEXT NOT NULL DEFAULT '',
  `parent_comment_id` INT UNSIGNED NULL,
  PRIMARY KEY (`id`),
  INDEX (`theme_id`),
  FOREIGN KEY (`theme_id`) REFERENCES `themes`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`parent_comment_id`) REFERENCES `comment_themes`(`id`) ON DELETE SET NULL ON UPDATE SET NULL
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `image_apps` (
  `id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `app_id` MEDIUMINT UNSIGNED NOT NULL,
  `alt` VARCHAR(70) NULL,
  `path_image` VARCHAR(255) NOT NULL,
  `width_px` SMALLINT UNSIGNED NOT NULL DEFAULT 600,
  `height_px` SMALLINT UNSIGNED NOT NULL DEFAULT 600,
  PRIMARY KEY (`id`),
  INDEX (`app_id`),
  FOREIGN KEY (`app_id`) REFERENCES `apps`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `image_themes` (
  `id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `theme_id` MEDIUMINT UNSIGNED NOT NULL,
  `alt` VARCHAR(70) NULL,
  `path_image` VARCHAR(255) NOT NULL,
  `width_px` SMALLINT UNSIGNED NOT NULL DEFAULT 600,
  `height_px` SMALLINT UNSIGNED NOT NULL DEFAULT 600,
  PRIMARY KEY (`id`),
  INDEX (`theme_id`),
  FOREIGN KEY (`theme_id`) REFERENCES `themes`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `badges` (
  `id` TINYINT NOT NULL DEFAULT 1,
  `partner_id` SMALLINT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`, `partner_id`),
  FOREIGN KEY (`partner_id`) REFERENCES `partners`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `category_apps` (
  `id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR (20) NOT NULL DEFAULT '',
  PRIMARY KEY(`id`)
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `relationship_category_apps` (
  `app_id` MEDIUMINT UNSIGNED NOT NULL,
  `category_apps_id` MEDIUMINT UNSIGNED NOT NULL,
  PRIMARY KEY (`app_id`, `category_apps_id`),
  FOREIGN KEY (`app_id`) REFERENCES `apps`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`category_apps_id`) REFERENCES `category_apps`(`id`) on DELETE CASCADE on UPDATE CASCADE
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `category_themes` (
  `id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR (20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `relationship_category_themes` (
  `theme_id` MEDIUMINT UNSIGNED NOT NULL,
  `category_themes_id` MEDIUMINT  UNSIGNED NOT NULL,
  PRIMARY KEY (`theme_id`, `category_themes_id`),
  FOREIGN KEY (`theme_id`) REFERENCES `themes`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`category_themes_id`) REFERENCES `category_themes`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `historic_transaction` (
  `id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `partner_id` SMALLINT UNSIGNED NULL,
  `store_id` MEDIUMINT UNSIGNED NULL,
  `app_id` MEDIUMINT UNSIGNED NULL,
  `theme_id` MEDIUMINT UNSIGNED NULL,
  `transaction_code` VARCHAR(255) NULL,
  `notes` TEXT NULL,
  `description` VARCHAR (255) NULL,
  `payment_value` MEDIUMINT NOT NULL DEFAULT 0,
  `date_transaction` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  INDEX (`partner_id`, `store_id`, `app_id`, `theme_id`),
  FOREIGN KEY (`partner_id`) REFERENCES `partners`(`id`),
  FOREIGN KEY (`theme_id`) REFERENCES `themes`(`id`),
  FOREIGN KEY (`app_id`) REFERENCES `apps`(`id`)
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `historic_withdrawal` (
  `id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `partner_id` SMALLINT UNSIGNED NOT NULL,
  `date_withdrawal` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `value_withdrawal` MEDIUMINT UNSIGNED NOT NULL DEFAULT 0,
  `transaction_code` VARCHAR(255) NULL,
  `notes` TEXT NULL,
  PRIMARY KEY (`id`),
  INDEX (`partner_id`),
  FOREIGN KEY (`partner_id`) REFERENCES `partners` (`id`)
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `buy_apps` (
  `id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `app_id` MEDIUMINT UNSIGNED NOT NULL,
  `store_id` MEDIUMINT UNSIGNED NOT NULL,
  `date_init` DATE NOT NULL,
  `date_end` DATE NOT NULL,
  `date_renovation` DATE NOT NULL,
  `type_plan` TINYINT NOT NULL DEFAULT 0,
  `app_value` MEDIUMINT UNSIGNED NOT NULL DEFAULT 0,
  `payment_status` TINYINT NOT NULL DEFAULT 0,
  `plan_id` MEDIUMINT NULL,
  `id_transaction` MEDIUMINT UNSIGNED NULL,
  PRIMARY KEY (`id`),
  INDEX (`app_id`, `store_id`),
  FOREIGN KEY (`app_id`) REFERENCES `apps`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`id_transaction`) REFERENCES `historic_transaction`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `buy_themes` (
  `id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `theme_id` MEDIUMINT UNSIGNED NOT NULL,
  `store_id` MEDIUMINT UNSIGNED NOT NULL,
  `theme_value` MEDIUMINT UNSIGNED NOT NULL DEFAULT 0,
  `payment_status` TINYINT NOT NULL DEFAULT 0,
  `license_type` TINYINT NOT NULL DEFAULT 0,
  `id_transaction` MEDIUMINT UNSIGNED NULL,
  `template_id` TINYINT NOT NULL DEFAULT 0,
  PRIMARY KEY(`id`),
  INDEX (`theme_id`, `store_id`),
  FOREIGN KEY (`theme_id`) REFERENCES `themes`(`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`id_transaction`) REFERENCES `historic_transaction`(`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `store` (
  `store_id` MEDIUMINT UNSIGNED NOT NULL,
  `credits` MEDIUMINT NOT NULL DEFAULT 0
) ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci;
