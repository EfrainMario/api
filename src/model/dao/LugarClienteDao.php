<?php

require_once (__DIR__."/../ConexaoBD.php");

    class LugarClienteDao{

        public $database;
     
        public function __construct() {

            $conexao = new ConexaoBD();
            $this->database = $conexao->database;  

        }

        //subelemento lugares do cliente
        public function getClienteLugares($idCliente){
            $resultado = $this->database->select('lugarcliente', "*",
            [
                'idCliente' => $idCliente
            ]);

            return $resultado;
        }

        public function getClienteLugaresID($idLugar, $idCliente){
            
            $resultado = $this->database->select('lugarcliente', "*",
            [
                'id' => $idLugar,
                'idCliente' => $idCliente
            ]);

            return $resultado;
        }

        public function postClienteLugares($idCliente, $json){ 

            $resultado = $this->database->insert('lugarcliente', [
                "idCliente" => $idCliente,
                "latitude" => $json["latitude"],
                "longitude" => $json["longitude"],
                "endereco" => $json["endereco"],
                "descricaoLocal" => $json["descricaoLocal"]
            ]);

            return $resultado;
        }

        public function putClienteLugares($idLugar, $json){

            $resultado = $this->database->update('lugarcliente', 
            [
                "latitude" => $json["latitude"],
                "longitude" => $json["longitude"],
                "endereco" => $json["endereco"],
                "descricaoLocal" => $json["descricaoLocal"]
            ],[
                'id' => $idLugar
            ]);   

            return $resultado;
        }

        



    }
    
?>