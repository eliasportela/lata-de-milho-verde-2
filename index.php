<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require './vendor/autoload.php';
require './src/config/db.php';
require './src/model/crud.php';

$app = new \Slim\App(array('debug' => true));

$app->add(function ($req, $res, $next) {
	$response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});

/*/
	Include automatico dos controllers
/*/
$filepath = './src/controller/';
$files = scandir($filepath);
foreach ($files as $file) {
    // match the file extension to .php
    if (substr($file,-4,4) == '.php') 
    {
    	require $filepath.$file;
    }
}


$app->run();