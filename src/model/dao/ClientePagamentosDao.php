<?php

require_once (__DIR__."/../ConexaoBD.php");

    class ClienteDao{

        public $database;
     
        public function __construct() {

            $conexao = new ConexaoBD();
            $this->database = $conexao->database;  

        }

        public function getPagamento(){
            $resultado = $this->database->select("pagamento", "*");

            return $resultado;
        }

        public function getPagamentoId($id){
            $resultado = $this->database->select('pagamento', "*", [
                'id' => $id
            ]);

            return $resultado;
        }


        public function postPagamento($json){
            $resultado = $this->database->insert('cliente', [
                "idPedido" => $json['idPedido'],
                "valor" => $json['valor'],
                "valorEntregador" => $json['valorEntregador'],
                "valorLoja" => $json['valorLoja'],
                "lucro" => $json['lucro'],
                "dataHora" => $json['dataHora'],
            ]);

            return $resultado;
        }

    }
    
?>