<?php

require_once (__DIR__."/../controller/FCMController.php");

/*
 *   @Company: Vectis
 *   @Author: Cândido M.J.Fernandes Malavoloneque
 *   @Description: API clientes
*/

use Slim\Http\Request;
use Slim\Http\Response;

$app->post('/pushmessage/lojas/{id:[0-9]+}', function (Request $request, Response $response, array $args) {
    
    $fcmController = new FCMController($request, $response, $args);
    return $fcmController->sendToLojaById();
});


$app->post('/pushmessage/clientes/{id:[0-9]+}', function (Request $request, Response $response, array $args) {
    
    $fcmController = new FCMController($request, $response, $args);
    return $fcmController->sendToClienteById();
});

/*$app->post('/pushmessage/clientes/{token}', function (Request $request, Response $response, array $args) {
        
    $fcmController = new FCMController($request, $response, $args);
    return $fcmController->sendToClienteByToken();
});*/


/*
$app->post('/pushmessage/lojas/{token}', function (Request $request, Response $response, array $args) {
    
    $fcmController = new FCMController($request, $response, $args);
    return $fcmController->sendToClienteByToken();
});*/

?>