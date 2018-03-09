# LMV2 RESTful API (Lata de milho verde 2)

Mini framework Restful API em PHP com geração automática de CRUD 

### Version
2.0.0

### Estrutura
A estrutura do projeto

src/
__config/
____db.php
__controller/
____cidade.php
__model/
____crud.php
vendor/
.gitignore
.htaccess
README.md
composer.json
composer.lock
index.php

### Usage

Acesse 'src/config/' e altere os dados da conexão com o banco de dados

private $dbhost = 'localhost'; //Local do HOST do banco de dados
private $dbuser = 'root'; //Usuário do banco
private $dbpass = 'root'; //Senha do banco
private $dbname = 'spin'; //Nome do banco


Acesse 'src/controller/', copie e cole o script padrão (cidade.php) na mesma pasta 'src/controller/' e altere as constantes com o nome da tabela do banco e a chave primária

//nome da tabela do BD
define('TABELABD', 'cidade');
//nome da chave primaria
define('PRIMARYKEY', 'id_cidade');

Se necessário criar o próprio select, no final da página altere o nome da rota

$app->get('/'.TABELABD.'-rota', function(Request $request, Response $response){

para o nome desejado, sendo assim ficará 'TABELABD/rota'. EX: 'cidade-região'

$app->get('/'.TABELABD.'-regiao', function(Request $request, Response $response){

// DADOS PARA UMA INSTRUCAO SQL
$app->get('/'.TABELABD.'-regiao', function(Request $request, Response $response){
    $model = new model();
    $model->Query("SELECT id_cidade FROM cidade");
});


### Installation
É necessário o $composer para instalção das dependencias

git clone ""
cd lata-de-milho-verd-2/

Instale o SlimPHP e dependencias com o comanda

composer install

### API Endpints
```sh
$ GET /cidade
$ GET /cidade/{id}
$ POST /cidade/add
$ POST /cidade/update/{id}
$ DELETE /cidade/delete/{id}
```
