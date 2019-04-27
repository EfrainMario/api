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
        return $response->withHeader("Access-Control-Allow-Origin", 'http://www.lubeasy.com')
                        ->withHeader("Access-Control-Allow-Methods", "POST, GET, OPTIONS, DELETE")
                        ->withHeader("Access-Control-Max-Age", "3600")
                        ->withHeader("Access-Control-Allow-Headers", "Content-Type, Accept, X-Requested-With, remember-me")
                        ->withHeader("Access-Control-Allow-Credentials", 'true')
                        ->withStatus(204)->write("");
    }

    return $response->withHeader("Access-Control-Allow-Origin", 'http://www.lubeasy.com')
                    ->withHeader("Access-Control-Allow-Methods", "POST, GET, OPTIONS, DELETE")
                    ->withHeader("Access-Control-Max-Age", "3600")
                    ->withHeader("Access-Control-Allow-Headers", "Content-Type, Accept, X-Requested-With, remember-me")
                    ->withHeader("Access-Control-Allow-Credentials", 'true')
                    ->withJson($resultado, 200);
});