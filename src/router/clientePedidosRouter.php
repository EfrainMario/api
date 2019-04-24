<?php

require_once (__DIR__."/../controller/ClientePedidosController.php");

/*
 *   @Company: Vectis
 *   @Author: Cândido M.J.Fernandes Malavoloneque
 *   @Description: API clientes
*/

use Slim\Http\Request;
use Slim\Http\Response;

//endpoints para subelementos do recurso clientes <<pedidos>>

$app->get('/clientes/{id:[0-9]+}/pedidos', function (Request $request, Response $response, array $args) {
    $clientePedidosController = new ClientePedidosController($request, $response, $args);
    return $clientePedidosController->getClientePedidos();

});

$app->get('/clientes/{id:[0-9]+}/pedidos/{_id:[0-9]+}', function (Request $request, Response $response, array $args) {
    $clientePedidosController = new ClientePedidosController($request, $response, $args);
    return $clientePedidosController->getClientePedidosID();
});

$app->post('/clientes/{id:[0-9]+}/pedidos', function (Request $request, Response $response, array $args) {
    $clientePedidosController = new ClientePedidosController($request, $response, $args);
    return $clientePedidosController->postClientePedidos();

});

$app->put('/clientes/{id:[0-9]+}/pedidos/{_id:[0-9]+}', function (Request $request, Response $response, array $args) {
    $clientePedidosController = new ClientePedidosController($request, $response, $args);
    return $clientePedidosController->putClientePedidos();

});