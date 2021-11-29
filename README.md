# LaraPages
Esse projeto trata-se de uma estrutura utilizando o framework [Laravel](https://laravel.com) e com um painel administrativo criado usando o [AdminLTE](https://github.com/jeroennoten/Laravel-AdminLTE).

## Overview
### Requisitos
O projeto funciona usando o [Laravel 7.x](https://laravel.com/docs/7.x#server-requirements) que já possui seus próprios requisitos. Além deles, é necessário:
- PHP ^8.0
- Composer ^2
- NPM ^6.14
### Instalação
Para rodar a aplicação localmente, siga os passos abaixos:
1. Execute os seguintes comandos na raiz do projeto `composer install` e `npm i` para instalar as dependências.
2. Execute o comando `cp .env.example .env` para criar um arquivo de ambiente com base no exemplo. Configure as variáveis conforme o seu ambiente.
3. Execute o comando `php artisan key:generate` para gerar uma chave de criptografia na aplicação.
4. Execute o comando `php artisan link:storage` para criar um caminho publico para a pasta de uploads.
5. Execute o comando `php artisan migrate --seed` para criar a estrutura do banco de dados com o primeiro usuário cadastrado. E-mail: *admin@mail.com*; Senha: 123456.
6. Execute o comando `php artisan serve` para executar a aplicação utilizando o servidor embutido do PHP. A aplicação subirá em localhost na porta 8000.

## Comandos personalizados
Para criar rapidamente CRUDs no painel administrativo pode-se usar o comando:
`php artisan lc:files {plural} {singular} {--noModel}`
Onde `plural` representa o conteúdo escrito no plural e `{singular}` escrito no singular. Caso a flag `--noModel` não seja passada, o comando irá criar um model com migration.
Ex.: `php artisan lc:files users user --noModel`
O comando irá criar um controller em `app\Http\Controllers\Admin\`, irá criar as views para o CRUD em `resources\views\admin\{singular}` e irá exibir na saída do terminal um bloco de rotas para ser inseridas conforme sua necessidade. Caso a flag `--noModel` não seja informada, o comando irá criar um Model em `app\Models\DB`.