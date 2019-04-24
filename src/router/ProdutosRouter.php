<?php

require_once __DIR__ . "/../model/dao/ProdutoDao.php";

use Slim\Http\Request;
use Slim\Http\Response;
use Slim\Http\UploadedFile;

//Listar todas as produtos
$app->get('/produtos', function (Request $request, Response $response, array $args) {
    $produtoDao = new ProdutoDao();

    $resultado = $produtoDao->pegarTodosProdutos();

    if ($resultado == null) {
        return $response->withStatus(204)->write("Ainda não existem produtos.");
    }

    return $response->withJson($resultado, 200);
});
//Listar Produtos...
$app->get('/produtos/{id:[0-9]+}', function (Request $request, Response $response, array $args) {
    $produtoDao = new ProdutoDao();
    $id = $args['id'];
    $resultado = $produtoDao->pegarProdutoPeloId($id);
    if ($resultado == null) {
        return $response->withStatus(204)->write("Produto não encontrado.");
    }

    return $response->withJson($resultado[0], 200);
});
//Listar produtos com nome...
$app->get('/produtos/{nome:[a-zA-Z0-9]+}', function (Request $request, Response $response, array $args) {
    $produtoDao = new ProdutoDao();
    $nome = $args['nome'];
    $resultado = $produtoDao->pegarProdutosPeloNome($nome);
    if ($resultado == null) {
        return $response->withStatus(204)->write("De momento não existem produtos com este nome.");
    }

    return $response->withJson($resultado,200);
});
//Actualizar imagem produtos
$app->post('/produtos/{id:[0-9]+}/logos', function (Request $request, Response $response, array $args)
{
    $jsonInArray = $_FILES['logo'];
    if($jsonInArray != null)
    {
        $id = $args['id'];
        $produtoDao = new ProdutoDao();
        $resultado = $produtoDao->actualizarImagemDoProduto($id,$jsonInArray);

        if($resultado->rowCount() > 0){
            return $response->withStatus(201)->write('Imagem adicionada.');
        }else{
            return $response->withStatus(400)->write('Erro ao adicionar a imagem.');
        }

    }else{
        return $response->withStatus(500)->write('Um erro desconhecido ocorreu ao criar a loja.');
    }
});
