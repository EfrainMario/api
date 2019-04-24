<?php

require_once (__DIR__."/../ConexaoBD.php");

    class ClienteDao{

        public $database;
     
        public function __construct() {

            $conexao = new ConexaoBD();
            $this->database = $conexao->database;  

        }

        public function getClientes(){
            $resultado = $this->database->select("cliente", "*");

            return $resultado;
        }

        public function getClientesID($id){
            $resultado = $this->database->select('cliente', "*", [
                'id' => $id
            ]);

            return $resultado;
        }

        public function getClientesQuery($queryParams){

            $resultado = $this->database->select('cliente',"*", [
                "email" => $queryParams['email'],
                "senha" => $queryParams['senha']
            ]);

            return $resultado;
        }

        public function postClientes($json){
            $resultado = $this->database->insert('cliente', [
                "nome" => $json['nome'],
                "senha" => $json['senha'],
                "email" => $json['email'],
                "telefone" => $json['telefone'],
                "fcmToken" => $json['fcmToken'],
                "latitude" => $json['latitude'],
                "longitude" => $json['longitude'],
                "online" => $json['online'],
                "criacao" => $json['criacao'],
            ]);

            return $resultado;
        }

        public function putClientes($id, $json){
            $resultado = $this->database->update('cliente', 
            [
                "nome" => $json['nome'],
                "senha" => $json['senha'],
                "email" => $json['email'],
                "telefone" => $json['telefone'],
                "fcmToken" => $json['fcmToken'],
                "latitude" => $json['latitude'],
                "longitude" => $json['longitude'],
                "online" => $json['online']
            ],[
                'id' => $id
            ]);   

            return $resultado;
        }

        public function deleteClientes($id){
            $resultado = $this->database->delete('cliente',[
                'id' => $id
            ]);

            return $resultado;
        }

    }
    
?>