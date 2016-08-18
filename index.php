<?php

require_once("Slim/Slim.php");
require_once("aplicacao/controllers/controllerUsuario.php");

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app -> post('/usuario/', function() use($app) {
    $request = $app->request();
    $controller = new ControllerUsuario();
    $controller -> Cadastrar($request);
});

$app -> get('/usuario/', function(){
    $controller = new ControllerUsuario();
    $controller -> Listar();
});

$app -> run();

?>				