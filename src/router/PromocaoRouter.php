<?php

require_once __DIR__ . "/../model/dao/PromocaoDao.php";

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\UploadedFile;

//Listar todas as  promocoes
$app->get('/promocoes', function (Request $request, Response $response, array $args) {
    $promocaoDao = new PromocaoDao();

    $resultado = $promocaoDao->pegarTodasAsPromocoes();

    if ($resultado == null) {
        return $response->withHeader("Access-Control-Allow-Origin", 'http://www.lubeasy.com')
                        ->withHeader("Access-Control-Allow-Methods", "POST, GET, OPTIONS, DELETE")
                        ->withHeader("Access-Control-Max-Age", "3600")
                        ->withHeader("Access-Control-Allow-Headers", "Content-Type, Accept, X-Requested-With, remember-me")
                        ->withHeader("Access-Control-Allow-Credentials", 'true')
                        ->withStatus(204)->write("Ainda não existem promocoes.");
    }

    return $response->withJson($resultado, 200);
});
//Listar todas as  promocoes da loja
$app->get('/lojas/{id:[0-9]+}/promocoes', function (Request $request, Response $response, array $args) {
    $promocaoDao = new PromocaoDao();
    $idLloja = $args['id'];
    $resultado = $promocaoDao->pegarTodasAsPromocoesDaLoja($idLloja);

    if ($resultado == null) {
        return $response->withHeader("Access-Control-Allow-Origin", 'http://www.lubeasy.com')
                        ->withHeader("Access-Control-Allow-Methods", "POST, GET, OPTIONS, DELETE")
                        ->withHeader("Access-Control-Max-Age", "3600")
                        ->withHeader("Access-Control-Allow-Headers", "Content-Type, Accept, X-Requested-With, remember-me")
                        ->withHeader("Access-Control-Allow-Credentials", 'true')
                        ->withStatus(204)->write("Ainda não existem promocoes.");
    }

    return $response->withHeader("Access-Control-Allow-Origin", 'http://www.lubeasy.com')
                    ->withHeader("Access-Control-Allow-Methods", "POST, GET, OPTIONS, DELETE")
                    ->withHeader("Access-Control-Max-Age", "3600")
                    ->withHeader("Access-Control-Allow-Headers", "Content-Type, Accept, X-Requested-With, remember-me")
                    ->withHeader("Access-Control-Allow-Credentials", 'true')
                    ->withJson($resultado, 200);
});
//Listar Promocao...
$app->get('/promocoes/{id:[0-9]+}', function (Request $request, Response $response, array $args) {
    $promocaoDao = new PromocaoDao();
    $id = $args['id'];
    $resultado = $promocaoDao->pegarPromocao($id);
    if ($resultado == null) {
        return $response->withHeader("Access-Control-Allow-Origin", 'http://www.lubeasy.com')
                        ->withHeader("Access-Control-Allow-Methods", "POST, GET, OPTIONS, DELETE")
                        ->withHeader("Access-Control-Max-Age", "3600")
                        ->withHeader("Access-Control-Allow-Headers", "Content-Type, Accept, X-Requested-With, remember-me")
                        ->withHeader("Access-Control-Allow-Credentials", 'true')
                        ->withStatus(204)->write("Promocao não encontrada.");
    }
    return $response->withHeader("Access-Control-Allow-Origin", 'http://www.lubeasy.com')
                    ->withHeader("Access-Control-Allow-Methods", "POST, GET, OPTIONS, DELETE")
                    ->withHeader("Access-Control-Max-Age", "3600")
                    ->withHeader("Access-Control-Allow-Headers", "Content-Type, Accept, X-Requested-With, remember-me")
                    ->withHeader("Access-Control-Allow-Credentials", 'true')
                    ->withJson($resultado[0], 200);
});
//Criar Promocao
$app->post('/lojas/{id:[0-9]+}/promocoes', function (Request $request, Response $response, array $args)
{
    $imagem = $_FILES['imagem'];
    $jsonInArray = json_decode($this->request->getParam('json'), true);
    if ($jsonInArray)
    {
        $jsonInArray['idLoja'] = $args['id'];
        $promocaoDao = new PromocaoDao();

        $resultado = $promocaoDao->criarPromocao($jsonInArray, $imagem);

        if($resultado->rowCount() > 0){
            return $response->withHeader("Access-Control-Allow-Origin", 'http://www.lubeasy.com')
                            ->withHeader("Access-Control-Allow-Methods", "POST, GET, OPTIONS, DELETE")
                            ->withHeader("Access-Control-Max-Age", "3600")
                            ->withHeader("Access-Control-Allow-Headers", "Content-Type, Accept, X-Requested-With, remember-me")
                            ->withHeader("Access-Control-Allow-Credentials", 'true')
                            ->withStatus(200)->write('Promocao criada.');
        }else{
            return $response->withHeader("Access-Control-Allow-Origin", 'http://www.lubeasy.com')
                            ->withHeader("Access-Control-Allow-Methods", "POST, GET, OPTIONS, DELETE")
                            ->withHeader("Access-Control-Max-Age", "3600")
                            ->withHeader("Access-Control-Allow-Headers", "Content-Type, Accept, X-Requested-With, remember-me")
                            ->withHeader("Access-Control-Allow-Credentials", 'true')
                            ->withStatus(400)->write('Erro ao criar a promocao.');
        }

    }else{
        return $response->withHeader("Access-Control-Allow-Origin", 'http://www.lubeasy.com')
                        ->withHeader("Access-Control-Allow-Methods", "POST, GET, OPTIONS, DELETE")
                        ->withHeader("Access-Control-Max-Age", "3600")
                        ->withHeader("Access-Control-Allow-Headers", "Content-Type, Accept, X-Requested-With, remember-me")
                        ->withHeader("Access-Control-Allow-Credentials", 'true')
                        ->withStatus(500)->write('Um erro desconhecido ocorreu ao criar a promocao.');
    }
});


$app->post('/lojas/{id:[0-9]+}/promocoes/{_id:[0-9]+}/imagens', function (Request $request, Response $response, array $args)
{
    $imagem = $_FILES['imagem'];
    if ($imagem)
    {
        $id = $args['_id'];
        $idLoja = $args['id'];
        $promocaoDao = new PromocaoDao();

        $resultado = $promocaoDao->actualizarPromocaoImagem($id, $idLoja, $imagem);

        if($resultado->rowCount() > 0){
            return $response->withHeader("Access-Control-Allow-Origin", 'http://www.lubeasy.com')
                            ->withHeader("Access-Control-Allow-Methods", "POST, GET, OPTIONS, DELETE")
                            ->withHeader("Access-Control-Max-Age", "3600")
                            ->withHeader("Access-Control-Allow-Headers", "Content-Type, Accept, X-Requested-With, remember-me")
                            ->withHeader("Access-Control-Allow-Credentials", 'true')
                            ->withStatus(204)->write('Promocao criada.');
        }else{
            return $response->withHeader("Access-Control-Allow-Origin", 'http://www.lubeasy.com')
                            ->withHeader("Access-Control-Allow-Methods", "POST, GET, OPTIONS, DELETE")
                            ->withHeader("Access-Control-Max-Age", "3600")
                            ->withHeader("Access-Control-Allow-Headers", "Content-Type, Accept, X-Requested-With, remember-me")
                            ->withHeader("Access-Control-Allow-Credentials", 'true')
                            ->withStatus(400)->write('Erro ao criar a promocao.');
        }

    }else{
        return $response->withHeader("Access-Control-Allow-Origin", 'http://www.lubeasy.com')
                        ->withHeader("Access-Control-Allow-Methods", "POST, GET, OPTIONS, DELETE")
                        ->withHeader("Access-Control-Max-Age", "3600")
                        ->withHeader("Access-Control-Allow-Headers", "Content-Type, Accept, X-Requested-With, remember-me")
                        ->withHeader("Access-Control-Allow-Credentials", 'true')
                        ->withStatus(500)->write('Um erro desconhecido ocorreu ao criar a promocao.');
    }
});
//Actualizar promocao
$app->put('/lojas/{id:[0-9]+}/promocoes/{_id:[0-9]+}', function (Request $request, Response $response, array $args)
{
    $jsonInArray = $request->getParsedBody();
    if($jsonInArray != null)
    {
        $promocaoDao = new PromocaoDao();
        $idLoja = $args['id'];
        $id = $args['_id'];
        $resultado = $promocaoDao->actualizarPromocao($id,$idLoja,$jsonInArray);

        if($resultado->rowCount() > 0){
            return $response->withHeader("Access-Control-Allow-Origin", 'http://www.lubeasy.com')
                            ->withHeader("Access-Control-Allow-Methods", "POST, GET, OPTIONS, DELETE")
                            ->withHeader("Access-Control-Max-Age", "3600")
                            ->withHeader("Access-Control-Allow-Headers", "Content-Type, Accept, X-Requested-With, remember-me")
                            ->withHeader("Access-Control-Allow-Credentials", 'true')
                            ->withStatus(201)->write('Promocao actualizada.');
        }else{
            return $response->withHeader("Access-Control-Allow-Origin", 'http://www.lubeasy.com')
                            ->withHeader("Access-Control-Allow-Methods", "POST, GET, OPTIONS, DELETE")
                            ->withHeader("Access-Control-Max-Age", "3600")
                            ->withHeader("Access-Control-Allow-Headers", "Content-Type, Accept, X-Requested-With, remember-me")
                            ->withHeader("Access-Control-Allow-Credentials", 'true')
                            ->withStatus(400)->write('Erro ao actualizar a promocao.');
        }

    }else{
        return $response->withHeader("Access-Control-Allow-Origin", 'http://www.lubeasy.com')
                        ->withHeader("Access-Control-Allow-Methods", "POST, GET, OPTIONS, DELETE")
                        ->withHeader("Access-Control-Max-Age", "3600")
                        ->withHeader("Access-Control-Allow-Headers", "Content-Type, Accept, X-Requested-With, remember-me")
                        ->withHeader("Access-Control-Allow-Credentials", 'true')
                        ->withStatus(500)->write('Um erro desconhecido ocorreu ao actualizar a promocao.');
    }
});

$app->delete('/lojas/{id:[0-9]+}/promocoes/{_id:[0-9]+}', function (Request $request, Response $response, array $args)
{
    $id = $args['_id'];
    if($id != null)
    {
        $promocaoDao = new PromocaoDao();
        $resultado = $promocaoDao->apagarPromocao($id);

        if($resultado->rowCount() > 0){
            return $response->withHeader("Access-Control-Allow-Origin", 'http://www.lubeasy.com')
                            ->withHeader("Access-Control-Allow-Methods", "POST, GET, OPTIONS, DELETE")
                            ->withHeader("Access-Control-Max-Age", "3600")
                            ->withHeader("Access-Control-Allow-Headers", "Content-Type, Accept, X-Requested-With, remember-me")
                            ->withHeader("Access-Control-Allow-Credentials", 'true')
                            ->withStatus(201)->write('Promocao actualizada.');
        }else{
            return $response->withHeader("Access-Control-Allow-Origin", 'http://www.lubeasy.com')
                            ->withHeader("Access-Control-Allow-Methods", "POST, GET, OPTIONS, DELETE")
                            ->withHeader("Access-Control-Max-Age", "3600")
                            ->withHeader("Access-Control-Allow-Headers", "Content-Type, Accept, X-Requested-With, remember-me")
                            ->withHeader("Access-Control-Allow-Credentials", 'true')
                            ->withStatus(400)->write('Erro ao actualizar a promocao.');
        }

    }else{
        return $response->withHeader("Access-Control-Allow-Origin", 'http://www.lubeasy.com')
                        ->withHeader("Access-Control-Allow-Methods", "POST, GET, OPTIONS, DELETE")
                        ->withHeader("Access-Control-Max-Age", "3600")
                        ->withHeader("Access-Control-Allow-Headers", "Content-Type, Accept, X-Requested-With, remember-me")
                        ->withHeader("Access-Control-Allow-Credentials", 'true')
                        ->withStatus(400)->write('Um erro desconhecido ocorreu ao actualizar a promocao.');
    }
});
