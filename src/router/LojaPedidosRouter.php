<?php

require_once (__DIR__."/../controller/LojaPedidosController.php");

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\UploadedFile;

$app->get('/lojas/{id:[0-9]+}/pedidos', function (Request $request, Response $response, array $args) {
    $lojaPedidosController = new LojaPedidosController($request, $response, $args);
    return $lojaPedidosController->getLojaPedidos();

});

$app->get('/lojas/{id:[0-9]+}/pedidos/{_id:[0-9]+}', function (Request $request, Response $response, array $args) {
    $lojaPedidosController = new LojaPedidosController($request, $response, $args);
    return $lojaPedidosController->getLojaPedidosID();
});


//Estado pedido
$app->post('/lojas/{id:[0-9]+}/pedidos/{_id:[0-9]+}', function (Request $request, Response $response, array $args)
{
        $lojaPedidosController = new LojaPedidosController($request, $response, $args);
        return $lojaPedidosController->postLojaPedidosID();
});
$app->put('/lojas/{id:[0-9]+}/pedidos/{_id:[0-9]+}', function (Request $request, Response $response, array $args)
{
    $lojaPedidosController = new LojaPedidosController($request, $response, $args);
    return $lojaPedidosController->putLojaPedidosID();
});