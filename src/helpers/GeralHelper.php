<?php
/**
 * Created by PhpStorm.
 * User: PAULINO-PC
 * Date: 25/01/2019
 * Time: 12:07
 */
$HOST = "http://localhost/www/vectis/api/loja/v1/src/";

function uploadedImage($imagem, $tipo)
{
    if(!file_exists(__DIR__.'/../img')) {
        mkdir(__DIR__ . '/../img');
    }
    if (!file_exists(__DIR__.'/../img/loja')){
        mkdir(__DIR__.'/../img/loja');
    }
    if (!file_exists(__DIR__.'/../img/produto')){
        mkdir(__DIR__.'/../img/produto');
    }
    if (!file_exists(__DIR__.'/../img/promocao')){
        mkdir(__DIR__.'/../img/promocao');
    }
    if ( $imagem != null ) {
        //Pega a extensão
        $extensao = substr($imagem['name'], -4);
        $imagem['name'] = 'img_'.date('u-i-H_d-m-Y').$extensao;

        //Caminho curto
        $pastaRelativa = "img/$tipo/";
        $imagem['caminhoCompleto'] =__DIR__.'/../'.$pastaRelativa.$imagem['name'];
        $imagem['caminho'] = $pastaRelativa.$imagem['name'];
        $i=0;
        while(file_exists($imagem['caminhoCompleto']))
        {
            $i++;
            $imagem['name'] = 'img_'.date('u-i-H_d-m-Y').$i.$extensao;
            $imagem['caminhoCompleto'] =__DIR__.'/../'.$pastaRelativa.$imagem['name'];
            $imagem['caminho'] = $pastaRelativa.$imagem['name'];
        }

        if(move_uploaded_file($imagem['tmp_name'],$imagem['caminhoCompleto'])){
            global $HOST;
            return $HOST.$imagem['caminho'];
        }
        return false;
    }
    return false;
}

function resultObject($resultado, $response){
    //Este metodo verifica o resultado
    //E retorna-o como jsonObject na resposta
    if ( $resultado != null ) {
        $clienteObject = $resultado[0];

        return $response->withJson($clienteObject, 200);

    } else {
        return $response->withStatus(404);
    }



}

function resultArray($resultado, $response){
    //Este metodo verifica o resultado
    //E retorna-o como jsonArray na resposta

    if ($resultado != null)
       return $response->withJson($resultado, 200);
    else
       return $response->withStatus(204);
}

function checkCountRowPut($resultado, $response){
    //Verifica o resultado com o method rowCout
    //E retorna o codido mais adequado com o verbo
    if( $resultado->rowCount() > 0 ){
        return $response->withStatus(200);
    }else{
        return $response->withStatus(400);
    }

}
function checkCountRowPost($resultado, $response){
    //Verifica o resultado com o method rowCout
    //E retorna o codido mais adequado com o verbo
    if( $resultado->rowCount() > 0 ){
        return $response->withStatus(201);
    }else{
        return $response->withStatus(400);
    }

}
