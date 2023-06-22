# Teste situacional Liberfly

Este é o projeto Laravel para o processo seletivo da Liberfly

## Requisitos
Os requisitos do processo seletivo são:
1. Criar dois endpoints utilizando PHP Laravel e banco de dados MySQL:
- Lista todos os dados na tabela;
- Listar um registro da tabela buscando por seu identificador.
2. Os endpoints devem possuir segurança com autenticação JWT;

3. Criar testes de integração para os dois endpoints;

4. Documentar os endpoints utilizando swagger.

## Rodar o projeto

Instale as dependencias do projeto com `Composer install`

Crie um arquivo `.env` com base no arquivo `.env.example` e o altere com base nas configurações de acesso do seu banco de dados

Gere uma nova chave de aplicativo executando o comando `php artisan key:generate`

Execute as migrações do banco de dados para criar as tabelas com o comando `php artisan migrate`

Inicie o servidor com o comando `php artisan serve`
### Testes

Conforme solicitado, foram criados testes de integração, para roda-los siga os seguintes passos:

1. Abra um terminal na raiz do projeto.

2. Execute o comando `php artisan test` para executar todos os testes.

O código dos testes pode ser encontrando em `\tests\Feature\` nos arquivos `getUserByIdTest.php` e `listAllUsersTest.php`
### Documentação

A documentação Swagger para este projeto está disponível no arquivo `swagger.yaml` no diretório `public/docs`.


