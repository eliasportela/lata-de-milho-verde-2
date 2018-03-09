<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

//nome da tabela do BD
define('TABELABD', 'cidade');
//nome da chave primaria
define('PRIMARYKEY', 'id_cidade');


/* 
    CODIGO AUTOMATICO

*/
// TODOS OS DADOS DAD TABELA
$app->get('/'.TABELABD, function(Request $request, Response $response){
    $model = new model();
    $model->ReadAll(TABELABD);
});

// UM DADO ESPECIFICO PELA CHAVE
$app->get('/'.TABELABD.'/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $model = new model();
    $model->Read(TABELABD,PRIMARYKEY,$id);
});

// ADCIONAR DADO
$app->post('/'.TABELABD.'/add', function(Request $request, Response $response){
    $dados = $request->getParsedBody();
    $model = new model();
    $model->Register(TABELABD,$dados); 
});

// UPDATE DADOS PELA CHAVE
$app->post('/'.TABELABD.'/update/{id}', function(Request $request, Response $response){
    $dados = $request->getParsedBody();
    $par = array(PRIMARYKEY => $request->getAttribute('id'));
    $model = new model();
    $model->update(TABELABD,$dados,$par);
});

// DELETE DADOS PELA CHAVE
$app->delete('/'.TABELABD.'/delete/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $model = new model();
    $model->Delete(TABELABD,PRIMARYKEY,$id);
});

// DADOS PARA UMA INSTRUCAO SQL
$app->get('/'.TABELABD.'-regiao', function(Request $request, Response $response){
    $model = new model();
    $model->Query("SELECT id_cidade FROM cidade");
});


//FIQUE A VONTADE PARA COPIAR E COLAR NOVAS ROTAS AQUI EM BAIXO