<?php

//require_once __DIR__ . "/../model/dao/PedidosAceitesDao.php";

/*use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\UploadedFile;
*/
/*//Listar todas as  promocoes
$app->get('/pedidosaceites', function (Request $request, Response $response, array $args) {
    $promocaoDao = new PedidosAceitesDao();

    $resultado = $promocaoDao->pegarTodosOsPedidosAceites();

    if ($resultado == null) {
        return $response->withStatus(204)->write("Ainda não existem pedidos.");
    }

    return $response->withJson($resultado, 200);
});
//Listar Promocao...
$app->get('/pedidosaceites/{id:[0-9]+}', function (Request $request, Response $response, array $args) {
    $promocaoDao = new PedidosAceitesDao();
    $id = $args['id'];
    $resultado = $promocaoDao->pegarPedidoAceite($id);
    if ($resultado == null) {
        return $response->withStatus(204)->write("Pedido não encontrada.");
    }
    return $response->withJson($resultado[0], 200);
});
//Criar Promocao
$app->post('/lojas/{idLoja:[0-9]+}/pedidosaceites', function (Request $request, Response $response, array $args)
{
    $jsonInArray = $request->getParsedBody();
    if ($jsonInArray)
    {
        $pedidosAceitesDao = new PedidosAceitesDao();

        $resultado = $pedidosAceitesDao->criarPedidoAceite($jsonInArray);

        if($resultado->rowCount() > 0){
            return $response->withStatus(201)->write('Pedido guardado.');
        }else{
            return $response->withStatus(400)->write('Erro ao guardar o pedido.');
        }

    }else{
        return $response->withStatus(500)->write('Um erro desconhecido ocorreu ao criar a promocao.');
    }
});
//Actualizar promocao
$app->put('/pedidosaceites/{id:[0-9]+}', function (Request $request, Response $response, array $args)
{
    $jsonInArray = $request->getParsedBody();
    if($jsonInArray != null)
    {
        $pedidosAceitesDao = new PedidosAceitesDao();
        $id = $args['id'];
        $resultado = $pedidosAceitesDao->actualizarPedidoAceite($id,$jsonInArray);

        if($resultado->rowCount() > 0){
            return $response->withStatus(201)->write('Pedido actualizado.');
        }else{
            return $response->withStatus(400)->write('Erro ao actualizar o pedido.');
        }

    }else{
        return $response->withStatus(500)->write('Um erro desconhecido ocorreu ao actualizar a pedido.');
    }
});
*/
