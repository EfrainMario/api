<?php

require_once (__DIR__."/../ConexaoBD.php");

    class FCMDao{

        public $database;
     
        public function __construct() {

            $conexao = new ConexaoBD();
            $this->database = $conexao->database;  

        }

        public function getClientesTokens(){
            $resultado = $this->database->select("cliente", "fcmToken");

            return $resultado;
        }

        public function getClienteTokenById($id){
            $resultado = $this->database->select('cliente', "fcmToken", [
                'id' => $id
            ]);

            return $resultado;
        }

        public function getLojasTokens(){
            $resultado = $this->database->select("loja", "fcmToken");

            return $resultado;
        }

        public function getLojaTokenById($id){
            $resultado = $this->database->select('loja', "fcmToken", [
                'id' => $id
            ]);

            return $resultado;
        }

    }
    
?>