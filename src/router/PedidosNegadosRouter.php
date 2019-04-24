<?php

require_once __DIR__ . "/../model/dao/PedidosNegadosDao.php";

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\UploadedFile;

//Listar todos os  Pedidos negados
$app->get('/pedidosnegados', function (Request $request, Response $response, array $args) {
    $pedidosNegadosDao = new PedidosNegadosDao();

    $resultado = $pedidosNegadosDao->pegarTodosOsPedidosNegados();

    if ($resultado == null) {
        return $response->withStatus(204)->write("Ainda não negaste nenhum pedido.");
    }

    return $response->withJson($resultado, 200);
});
//Listar pedidos negados...
$app->get('/pedidosnegados/{id:[0-9]+}', function (Request $request, Response $response, array $args) {
    $pedidosNegadosDao = new PedidosNegadosDao();
    $id = $args['id'];
    $resultado = $pedidosNegadosDao->pegarPedidoNegado($id);
    if ($resultado == null) {
        return $response->withStatus(204)->write("Pedido não encontrada.");
    }
    return $response->withJson($resultado[0], 200);
});

//Guardar pedido negado
$app->post('/lojas/{idLoja:[0-9]+}/pedidosnegados', function (Request $request, Response $response, array $args)
{
    $jsonInArray = $request->getParsedBody();
    if ($jsonInArray)
    {
        $pedidosNegadosDao = new PedidosNegadosDao();
        $jsonInArray['idLoja'] = $args['idLoja'];
        $resultado = $pedidosNegadosDao->criarPedidoNegado($jsonInArray);

        if($resultado->rowCount() > 0){
            return $response->withStatus(200)->write('Pedido negado.');
        }else{
            return $response->withStatus(400)->write('Erro ao negar o pedido.');
        }

    }else{
        return $response->withStatus(500)->write('Um erro desconhecido ocorreu ao negar a pedido.');
    }
});
//Actualizar pedido negado
$app->put('/pedidosnegados/{id:[0-9]+}', function (Request $request, Response $response, array $args)
{
    $jsonInArray = $request->getParsedBody();
    if($jsonInArray != null)
    {
        $pedidosNegadosDao = new PedidosNegadosDao();
        $id = $args['id'];
        $resultado = $pedidosNegadosDao->actualizarPedidoNegado($id,$jsonInArray);

        if($resultado->rowCount() > 0){
            return $response->withStatus(201)->write('Pedido actualizado.');
        }else{
            return $response->withStatus(400)->write('Erro ao actualizar a pedido.');
        }

    }else{
        return $response->withStatus(500)->write('Um erro desconhecido ocorreu ao actualizar a promocao.');
    }
});
