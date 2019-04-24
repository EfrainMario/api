<?php

require_once (__DIR__."/../controller/LojaProdutosController.php");

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\UploadedFile;

//Listar todas as lojas
$app->get('/lojas/{id:[0-9]+}/produtos', function (Request $request, Response $response, array $args) {
    $lojaProdutosController = new LojaProdutosController($request, $response, $args);
    return $lojaProdutosController->getLojaProdutos();

});

$app->get('/lojas/{id:[0-9]+}/produtos/{_id:[0-9]+}', function (Request $request, Response $response, array $args) {
    $lojaProdutosController = new LojaProdutosController($request, $response, $args);
    return $lojaProdutosController->getLojaProdutoID();

});

$app->post('/lojas/{id:[0-9]+}/produtos', function (Request $request, Response $response, array $args) {
    $lojaProdutosController = new LojaProdutosController($request, $response, $args);
    return $lojaProdutosController->postLojaProduto();

});
$app->post('/lojas/{id:[0-9]+}/produtos/{_id:[0-9]+}/imagens', function (Request $request, Response $response, array $args) {
    $lojaProdutosController = new LojaProdutosController($request, $response, $args);
    return $lojaProdutosController->postLojaProdutoImagem();

});

$app->put('/lojas/{id:[0-9]+}/produtos/{_id:[0-9]+}', function (Request $request, Response $response, array $args) {
    $lojaProdutosController = new LojaProdutosController($request, $response, $args);
     return $lojaProdutosController->putLojaProduto();
});

$app->delete('/lojas/{id:[0-9]+}/produtos/{_id:[0-9]+}', function (Request $request, Response $response, array $args) {
    $lojaProdutosController = new LojaProdutosController($request, $response, $args);
    return $lojaProdutosController->deleteLojaProduto();

});
