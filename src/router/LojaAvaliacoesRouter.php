<?php

require_once __DIR__ . "/../model/dao/LojaAvaliacoesDao.php";

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\UploadedFile;


//Listar loja...
$app->get('/lojas/{id:[0-9]+}/avaliacoes', function (Request $request, Response $response, array $args) {
    $loja = new LojaAvaliacoesDao();
    $id = $args['id'];
    $resultado = $loja->pegarAvaliacaoMediaDaLoja($id);
    if ($resultado == null) {
        return $response->withStatus(204)->write("");
    }

    return $response->withJson($resultado, 200);
});