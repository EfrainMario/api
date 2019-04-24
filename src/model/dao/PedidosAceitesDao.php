<?php
/**
 * Created by PhpStorm.
 * User: Paulino-Pc
 * Date: 18/08/2018
 * Time: 14:40
 */

require_once (__DIR__."/../ConexaoBD.php");


class PedidosAceitesDao
{
    private $database;
    private $produto;

    public function __construct()
    {
        $conexao = new ConexaoBD();
        $this->database = $conexao->database;

    }

    //GET
    function pegarPedidoAceite($id){
        $resultado = $this->database->select("pedidosAceites","*",
            [
                'id' => $id
            ]);

        return $resultado;
    }
    //GET
    function pegarTodosOsPedidosAceites(){
        $resultado = $this->database->select("pedidosAceites","*");
        return $resultado;
    }
    //POST
    function criarPedidoAceite($json)
    {
        //inserir
        $insert = $this->database->insert("pedidosAceites",
            [
                "idCliente" => $json['idCliente'],
                "idLoja" => $json['idLoja'],
                "idDelivery" => $json['idDelivery'],
                "idProdutos" => $json['idProdutos'],
                "precoTotal" => $json['precoTotal'],
                "estado" => $json['estado'],
                "idLugarCliente" => $json['idLugarCliente'],
                "data" => $json['data'],
                "tempoDePreparo" => $json['tempoDePreparo'],
                "tempoDeEntrega" => $json['tempoDeEntrega'],
                "isDelivery" => $json['isDelivery']
            ]);

        return $insert;
    }
    //POST
    function actualizarPedidoAceite($id, $json)
    {
        //inserir
        $resultado = $this->database->update("pedidosAceites",
            [
                "idCliente" => $json['idCliente'],
                "idLoja" => $json['idLoja'],
                "idDelivery" => $json['idDelivery'],
                "idProdutos" => $json['idProdutos'],
                "precoTotal" => $json['precoTotal'],
                "estado" => $json['estado'],
                "idLugarCliente" => $json['idLugarCliente'],
                "data" => $json['data'],
                "tempoDePreparo" => $json['tempoDePreparo'],
                "tempoDeEntrega" => $json['tempoDeEntrega'],
                "isDelivery" => $json['isDelivery']
            ],
            [
                "id" => $id
            ]);

        return $resultado;
    }
    function apagarPromocao($id)
    {
        /*$resultado = $this->database->delete("promocao",
            [
                'id' => $id
            ]);
        */
        return "E melhor por um campo oculto";//$resultado;
    }

}
