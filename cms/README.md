# Ice Cream CMS

Um mini sistema de gerenciamento de conteúdo.

### Requirements
##### AdminLTE
```cmd
composer require jeroennoten/laravel-adminlte
```

### Database Tables
```sql
CREATE TABLE `users` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) DEFAULT '',
    `email` VARCHAR(200) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `remember_token` VARCHAR(100),
    `email_verified_at` TIMESTAMP NULL,
    `type` INT UNSIGNED NOT NULL,
    `created_by` INT UNSIGNED NOT NULL,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY(id)
);

CREATE TABLE `site_settings` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `value` TEXT,
    `created_by` INT UNSIGNED NOT NULL,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY(id)
);

CREATE TABLE `panel_settings` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `value` TEXT,
    `created_by` INT UNSIGNED NOT NULL,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY(id)
);

CREATE TABLE `pages` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(100) NOT NULL,
    `slug` VARCHAR(100) NOT NULL,
    `body` TEXT,
    `created_by` INT UNSIGNED NOT NULL,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY(id)
);

CREATE TABLE `visitors` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `ip` VARCHAR(100),
    `page_id` INT UNSIGNED NOT NULL,
    `accessed_at` TIMESTAMP NULL,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE `menus` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `parent_id` INT UNSIGNED,
    `page_id` INT UNSIGNED NOT NULL,
    `created_by` INT UNSIGNED NOT NULL,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY (`id`)
);
```
