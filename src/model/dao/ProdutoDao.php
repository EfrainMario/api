<?php
/**
 * Created by PhpStorm.
 * User: candido
 * Date: 18/08/2018
 * Time: 14:40
 */

require_once (__DIR__."/../ConexaoBD.php");


class ProdutoDao
{
    private $database;

    public function __construct()
    {
        $conexao = new ConexaoBD();
        $this->database = $conexao->database;

    }

    //GET
    function pegarProdutoPeloId($id){
        $resultado = $this->database->select("produto","*",
            [
                'id' => $id
            ]);

        return $resultado;
    }

    //GET
    function getLojaProdutoPeloId($idLoja, $id){
        $resultado = $this->database->select("produto","*",
            [
                'id' => $id,
                'idLoja' => $idLoja,
            ]);

        return $resultado;
    }

    //GET
    function pegarTodosProdutos(){
        $resultado = $this->database->select("produto","*");
        return $resultado;
    }
    //GET
    function pegarProdutosDaLoja($idLoja){
        $resultado = $this->database->select("produto","*", ['idLoja'=>$idLoja]);
        return $resultado;
    }

    //GET
    function getLojaProdutosPeloNome($idLoja, $nome){
        $resultado = $this->database->select("produto","*", 
        [
            'nome[~]'=>$nome."_",
            'idLoja'=>$idLoja
        ]);
        return $resultado;
    }

    //GET
    function pegarProdutosPeloNome($nome){
        $resultado = $this->database->select("produto","*", ['nome[~]'=>$nome."_"]);
        return $resultado;
    }
    //POST
    function criarProduto($json){

        //inserir
        $insert = $this->database->insert("produto",
            [
                "nome" =>$json['nome'],
                "descricao" =>$json['descricao'],
                "imagem" =>$json['imagem'],
                "idLoja" =>$json['idLoja'],
                "preco" =>$json['preco'],
                "tempoDePreparo" =>$json['tempoDePreparo'],
                "criacao" =>$json['criacao']
            ]);

        return $insert;
    }
    //POST
    function actualizarProduto($id, $json){
        //inserir
        $resultado = $this->database->update("produto",
            [
                "nome" =>$json['nome'],
                "descricao" =>$json['descricao'],
                "imagem" =>$json['imagem'],
                "idLoja" =>$json['idLoja'],
                "preco" =>$json['preco'],
                "tempoDePreparo" =>$json['tempoDePreparo'],
                "criacao" =>$json['criacao']
            ],
            [
                "id"=>$id,
            ]);

        return $resultado;
    }
    //POST
    function actualizarImagemDoProduto($id, $imagem)
    {
        $img = uploadedImage($imagem, 'produto');
        $resultado = $this->database->update("produto",
            [
                "imagem"=> $img
            ],
            [
                "id"=>$id,
            ]);

        return $resultado;
    }
    //DELETE
    function apagarProduto($id){
        /*$resultado = $this->database->delete("loja",
            [
                'id' => $id
            ]);
        */
        return "E melhor por um campo oculto";//$resultado;
    }


    //POST
    function postLojaProduto($idLoja, $json){

        date_default_timezone_set( "Africa/Luanda");
        $json['criacao'] = date('Y-m-d H:i:s');

        $insert = $this->database->insert("produto",
            [
                "idLoja" => $idLoja,
                "categoria" => $json['categoria'],
                "nome" =>$json['nome'],
                "descricao" =>$json['descricao'],
                "imagem" =>$json['imagem'],
                "preco" =>$json['preco'],
                "tempoDePreparo" =>$json['tempoDePreparo'],
                "criacao" =>$json['criacao']
            ]);

        return $insert;
    }

    //PUT
    function putLojaProduto($id, $idLoja, $json){
        $resultado = $this->database->update("produto", $json
            /*[
                "nome" =>$json['nome'],
                "descricao" =>$json['descricao'],
                "imagem" =>$json['imagem'],
                "preco" =>$json['preco'],
                "tempoDePreparo" =>$json['tempoDePreparo']
            ]*/,
            [
                "id" => $id,
                "idLoja" => $idLoja
            ]);

        return $resultado;
    }
    
    //DELETE
    function deleteLojaProduto($id, $idLoja){
        $resultado = $this->database->delete("produto",
            [
                "id" => $id,
                "idLoja" => $idLoja
            ]);
        return $resultado;
    }
}
