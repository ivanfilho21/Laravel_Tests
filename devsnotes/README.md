# DEVSNOTES

API de anotações simples.

## O que o aplicativo faz?
- Lista
- Retorna
- Cria
- Atualiza
- Remove anotações

## Atributos
- id
- title
- body
- owner_id
- created_at
- updated_at

## Endpoints
- (GET)     /api/notes
- (GET)     /api/note/{id}
- (POST)    /api/note
- (PUT)     /api/note/{id}
- (DELETE)  /api/note/{id}

### Comando de criar a tabela
```sql
CREATE TABLE `notes` (
    `id` BIGINT UNSIGNED NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    `body` TEXT DEFAULT '',
    `id_owner` BIGINT UNSIGNED NOT NULL DEFAULT 0,
    `created_at` TIMESTAMP NULL,
    `updated_at` TIMESTAMP NULL
);
```