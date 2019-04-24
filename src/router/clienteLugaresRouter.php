<?php

require_once (__DIR__."/../controller/ClienteLugaresController.php");

/*
 *   @Company: Vectis
 *   @Author: Cândido M.J.Fernandes Malavoloneque
 *   @Description: API clientes
*/

use Slim\Http\Request;
use Slim\Http\Response;

//endpoints para subelementos do recurso clientes <<lugares>>
$app->get('/clientes/{id:[0-9]+}/lugares', function (Request $request, Response $response, array $args) {
    $clienteLugaresController = new ClienteLugaresController($request, $response, $args);
    return $clienteLugaresController->getClienteLugares();

});

$app->get('/clientes/{id:[0-9]+}/lugares/{_id:[0-9]+}', function (Request $request, Response $response, array $args) {
    $clienteLugaresController = new ClienteLugaresController($request, $response, $args);
    return $clienteLugaresController->getClienteLugaresID();

});

$app->post('/clientes/{id:[0-9]+}/lugares', function (Request $request, Response $response, array $args) {
    $clienteLugaresController = new ClienteLugaresController($request, $response, $args);
    return $clienteLugaresController->postClienteLugares();

});

$app->put('/clientes/{id:[0-9]+}/lugares/{_id:[0-9]+}', function (Request $request, Response $response, array $args) {
    $clienteLugaresController = new ClienteLugaresController($request, $response, $args);
    return $clienteLugaresController->putClienteLugares();

});

$app->delete('/clientes/{id:[0-9]+}/lugares/{_id:[0-9]+}', function (Request $request, Response $response, array $args) {
    $clienteLugaresController = new ClienteLugaresController($request, $response, $args);
    return $clienteLugaresController->deleteClienteLugares();

});

