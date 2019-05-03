<?php

require_once (__DIR__."/../ConexaoBD.php");

    class PedidosDao{

        public $database;
     
        public function __construct() {

            $conexao = new ConexaoBD();
            $this->database = $conexao->database;  
        }

        //subelemento pedidos do cliente
        public function getClientePedidos($idCliente){
            $resultado = $this->database->select('pedido', "*",
            [
                'idCliente' => $idCliente,
                "ORDER" => [ "id" => "DESC" ],
            ]);

            return $resultado;
        }

        public function getClientePedidosID($idPedido, $idCliente){
            
            $resultado = $this->database->select('pedido', "*",
            [
                'id' => $idPedido,
                'idCliente' => $idCliente,
                "ORDER" => [ "id" => "DESC" ],
            ]);

            return $resultado;
        }

        public function postClientePedidos($idCliente, $json){
            $resultado = $this->database->insert('pedido', [
                "idCliente" => $idCliente,
                "idLoja" => $json["idLoja"],
                "idEntregador" => $json["idEntregador"],
                "isDelivery" => $json["isDelivery"],
                "precoTotal" => $json["precoTotal"],
                "idProdutos" => $json["idProdutos"],
                "idLugarCliente" => $json["idLugarCliente"],
                "dataDeEmissao" => $json["dataDeEmissao"],
                "tempoDaLoja" => $json["tempoDaLoja"],
                "tempoDoEntregador" => $json["tempoDoEntregador"],
            ]);

            return $resultado;
        }

        public function putClientePedidos($idPedido, $json){
            //Pode-se depois implementar a funcao oferecer pedido
            //ao outro cliente, ai vai se alterar o idCliente

            $resultado = $this->database->update('pedido', 
            [
                "idLugarCliente" => $json["idLugarCliente"]
            ],[
                'id' => $idPedido
            ]);   

            return $resultado;
        }

        //subelemento pedidos da loja
        public function getLojaPedidos($idLoja, $parametros){
            $resultado = $this->database->select('pedido', [
                "[><]lugarcliente" => [ "idLugarCliente" => "id" ],
                "[><]cliente" => [ "idCliente" => "id" ]
            ],[
                "pedido.id",
                "pedido.idCliente",
                "pedido.idEntregador",
                "pedido.itensDoPedido",
                "pedido.subTotal",
                "pedido.total",
                "pedido.observacoes",
                "pedido.tempoDeEntrega",
                "pedido.formaDePagamento",
                "pedido.isAccept",
                "pedido.isNotAcceptDetail",
                "pedido.typePedido",
                "pedido.receptLojaTime",
                "pedido.deliveryTime",
                "pedido.clienteTime",
                "pedido.desconto",
                "pedido.codPedido",
                "pedido.idLugarCliente",
                "pedido.dataDeEmissao",
                "pedido.isPay",
                "pedido.payTime",
                "pedido.wasOpenForLoja",
                "pedido.isCancelled",

                "lugarcliente.idCliente",
                "lugarcliente.latitude",
                "lugarcliente.longitude",
                "lugarcliente.endereco",
                "lugarcliente.descricao",
                "lugarcliente.nome",

                "cliente.nome",

            ],
            $parametros+
            [
                'idLoja' => $idLoja,
                "ORDER" => [ "id" => "DESC" ]

            ]);

            return $resultado;
        }

        public function getLojaPedidosID($idPedido, $idLoja){
            
            $resultado = $this->database->select('pedido',
                [
                    "[><]lugarcliente" => [ "idLugarCliente" => "id" ],
                    "[><]cliente" => [ "idCliente" => "id" ]
                ],[
                    "pedido.id",
                    "pedido.idCliente",
                    "pedido.idEntregador",
                    "pedido.itensDoPedido",
                    "pedido.subTotal",
                    "pedido.total",
                    "pedido.observacoes",
                    "pedido.tempoDeEntrega",
                    "pedido.formaDePagamento",
                    "pedido.isAccept",
                    "pedido.isNotAcceptDetail",
                    "pedido.typePedido",
                    "pedido.receptLojaTime",
                    "pedido.deliveryTime",
                    "pedido.clienteTime",
                    "pedido.desconto",
                    "pedido.codPedido",
                    "pedido.idLugarCliente",
                    "pedido.dataDeEmissao",
                    "pedido.isPay",
                    "pedido.payTime",
                    "pedido.wasOpenForLoja",
                    "pedido.isCancelled",

                    "lugarcliente.idCliente",
                    "lugarcliente.latitude",
                    "lugarcliente.longitude",
                    "lugarcliente.endereco",
                    "lugarcliente.descricao",
                    "lugarcliente.nome",

                    "cliente.nome",

                ],
                [
                    'pedido.id' => $idPedido,
                    'pedido.idLoja' => $idLoja,
                    "ORDER" => [ "id" => "DESC" ],
                ]);
            return $resultado;
        }





        public function postLojaPedidos($idPedido, $json){
            $json['idPedido'] = $idPedido;
            $resultado = $this->database->insert('estadoPedido', $json
            /*[
                "idPedido" => $idPedido,
                "estado" => $json["estado"],
                "data" => $json["data"]
            ]*/);

            return $resultado;
        }

        public function putLojaPedidosID($idPedido, $idLoja,$data){

            $resultado = $this->database->update('pedido', $data,
                [
                    'id' => $idPedido,
                    'idLoja' => $idLoja,
                ]);

            return $resultado;
        }

    }
    
?>