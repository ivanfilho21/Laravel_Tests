# Laravel Tests

Projetos feitos duranto o aprendizado de Laravel.

### Instalação

1. na pasta do projeto, crie uma cópia do arquivo <b>.env.example</b> e o renomeie para <b>.env</b>.

2. cada projeto necessita de uma conexão ao banco de dados. No arquivo .env, altere as seguintes linhas, de acordo com a conexão do seu banco de dados. Os dados abaixo são os valores padrão:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

3. execute as migrations:
```php
php artisan migrate
```

4. para instalar as dependências, execute o comando:
```
composer install
```

5. rode o comando abaixo para gerar uma nova chave para o projeto que será salva no arquivo .env:
```php
php artisan key:generate
```

6. por fim, execute o servidor e abra o site no seu navegador favorito.
```php
php artisan serve
```
