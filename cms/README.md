# Ice Cream CMS

Um mini sistema de gerenciamento de conteúdo.

### Requirements
1. AdminLTE:
```cmd
composer require jeroennoten/laravel-adminlte
```

### Tabelas do banco de dados
```sql
CREATE TABLE `users` (
    `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) DEFAULT '',
    `email` VARCHAR(200) NOT NULL UNIQUE,
    `password` VARCHAR(255) NOT NULL,
    `remember_token` VARCHAR(100),
    `email_verified_at` TIMESTAMP NULL,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL,
    PRIMARY KEY(id)
);
```