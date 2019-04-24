<?php
/**
 * Created by PhpStorm.
 * User: Paulino-Pc
 * Date: 18/08/2018
 * Time: 14:40
 */

require_once (__DIR__."/../ConexaoBD.php");


class PromocaoDao
{
    private $database;
    private $produto;

    public function __construct()
    {
        $conexao = new ConexaoBD();
        $this->database = $conexao->database;

    }

    //GET
    function pegarPromocao($id){
        $resultado = $this->database->select("promocao","*",
            [
                'id' => $id
            ]);

        return $resultado;
    }
    //GET
    function pegarTodasAsPromocoes(){
        $resultado = $this->database->select("promocao","*");
        return $resultado;
    }
    //GET
    function pegarTodasAsPromocoesDaLoja($idLoja){
        $resultado = $this->database->select("promocao","*", ["idLoja" => $idLoja]);
        return $resultado;
    }
    //POST
    function criarPromocao($json, $imagem)
    {
        $imagem = uploadedImage($imagem, 'promocao');

        //inserir
        if($imagem){
            $json['imagem']= $imagem;
            $insert = $this->database->insert("promocao",
                [
                    "idLoja" => $json['idLoja'],
                    "preco" =>$json['preco'],
                    "nome" =>$json['nome'],
                    "imagem" => $json['imagem'],
                    "dataTermino" =>$json['dataTermino'],
                    "descricao" =>$json['descricao'],
                    "tempoDePreparo" =>$json['tempoDePreparo']
                ]);
        }
        return $insert;
    }
    //POST
    function actualizarPromocao($id,$idLoja, $json)
    {
        //inserir
        $resultado = $this->database->update("promocao", $json,
            [
                "id"=>$id,
                'idLoja'=>$idLoja,
            ]);

        return $resultado;
    }
    //POST
    function actualizarPromocaoImagem($id, $idLoja, $imagem)
    {
        $resultado = null;
        $foto = uploadedImage($imagem, 'promocao');
        //inserir
        if($foto){
            $resultado = $this->database->update("promocao", ['imagem' => $foto],
                [
                    "id"=>$id,
                    "idLoja"=>$idLoja,
                ]);
        }

        return $resultado;
    }
    //DELETE
    function apagarPromocao($id)
    {
        $resultado = $this->database->delete("promocao",
            [
                'id' => $id
            ]);
        
        return $resultado;
    }
}
