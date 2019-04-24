<?php
/**
 * Created by PhpStorm.
 * User: Paulino-Pc
 * Date: 18/08/2018
 * Time: 14:40
 */

require_once (__DIR__."/../ConexaoBD.php");


class PedidosNegadosDao
{
    private $database;
    private $produto;

    public function __construct()
    {
        $conexao = new ConexaoBD();
        $this->database = $conexao->database;

    }

    //GET
    function pegarPedidoNegado($id){
        $resultado = $this->database->select("pedidosNegados","*",
            [
                'id' => $id
            ]);

        return $resultado;
    }
    //GET
    function pegarTodosOsPedidosNegados(){
        $resultado = $this->database->select("pedidosNegados","*");
        return $resultado;
    }
    //POST
    function criarPedidoNegado($json)
    {




        //inserir
        $insert = $this->database->insert("pedidosNegados",
            [
                "idLoja" =>$json['idLoja'],
                "data" =>$json['data']
            ]);

        return $insert;
    }
    //POST
    function actualizarPedidoNegado($id, $json)
    {
        //inserir
        $resultado = $this->database->update("pedidosNegados",
            [
                "idLoja" =>$json['idLoja'],
                "data" =>$json['data']
            ],
            [
                "id" =>$id
            ]);

        return $resultado;
    }
}
