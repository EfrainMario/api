<?php

require_once (__DIR__."/../controller/ClientePagamentosController.php");

/*
 *   @Company: Vectis
 *   @Author: Cândido M.J.Fernandes Malavoloneque
 *   @Description: API clientes
*/

use Slim\Http\Request;
use Slim\Http\Response;

//endpoints para o recurso clientes

$app->get('/clientes', function (Request $request, Response $response, array $args) {
    $clienteController = new ClienteController($request, $response, $args);
    return $clienteController->getClientes();
});

$app->get('/clientes/{id:[0-9]+}', function (Request $request, Response $response, array $args) {
    $clienteController = new ClienteController($request, $response, $args);
    return $clienteController->getClientesID();
});

$app->post('/clientes', function (Request $request, Response $response, array $args) {
    $clienteController = new ClienteController($request, $response, $args);
    return $clienteController->postClientes();

});

$app->put('/clientes/{id:[0-9]+}', function (Request $request, Response $response, array $args) {
    $clienteController = new ClienteController($request, $response, $args);
    return $clienteController->putClientes();

});

$app->delete('/clientes/{id:[0-9]+}', function (Request $request, Response $response, array $args) {
    $clienteController = new ClienteController($request, $response, $args);
    return $clienteController->deleteClientes();

});