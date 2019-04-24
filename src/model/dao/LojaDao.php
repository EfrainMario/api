<?php
/**
 * Created by PhpStorm.
 * User: candido
 * Date: 18/08/2018
 * Time: 14:40
 */

require_once (__DIR__."/../ConexaoBD.php");
require_once (__DIR__."/../../helpers/GeralHelper.php");


class LojaDao
{
    private $database;

    public function __construct()
    {
        $conexao = new ConexaoBD();
        $this->database = $conexao->database;

    }

    //GET
    function pegarLojaPeloId($id){
        $resultado = $this->database->select("loja","*",
            [
                'id' => $id
            ]);

        return $resultado;
    }

    //GET
    function getLojaQueryLogin($queryParams){
        $resultado = $this->database->select('loja',"*", [
            "email" => $queryParams['email'],
            "senha" => $queryParams['senha']
        ]);

        return $resultado;
    }

    //GET
    function getLojaQueryLocation($queryParams){
        $calculos = "(6371*acos(cos(radians(".$queryParams["latitude"]."))*cos(radians(latitude))*cos(radians(longitude) - radians(".$queryParams['longitude']."))+sin(radians(".$queryParams["latitude"]."))*sin(radians(latitude))))";
        $sql = "SELECT id,nome,logotipo,telefone,entrada,saida,fcmToken,latitude,longitude,endereco,categoria,online,".$calculos." AS distancia FROM loja HAVING distancia <= ". $queryParams['distancia'] ." ORDER BY distancia";
        $resultado = $this->database->query($sql)->fetchAll();

        $resultAfter = array();

        for ($i = 0; $i < sizeof($resultado); $i++){
            $resultAfter[$i]['id'] = $resultado[$i]['id'];
            $resultAfter[$i]['nome'] = $resultado[$i]['nome'];
            $resultAfter[$i]['logotipo'] = $resultado[$i]['logotipo'];
            $resultAfter[$i]['telefone'] = $resultado[$i]['telefone'];
            $resultAfter[$i]['entrada'] = $resultado[$i]['entrada'];
            $resultAfter[$i]['saida'] = $resultado[$i]['saida'];
            $resultAfter[$i]['fcmToken'] = $resultado[$i]['fcmToken'];
            $resultAfter[$i]['latitude'] = $resultado[$i]['latitude'];
            $resultAfter[$i]['longitude'] = $resultado[$i]['longitude'];
            $resultAfter[$i]['endereco'] = $resultado[$i]['endereco'];
            $resultAfter[$i]['categoria'] = $resultado[$i]['categoria'];
            $resultAfter[$i]['online'] = $resultado[$i]['online'];
            $resultAfter[$i]['distancia'] =  round($resultado[$i]['distancia'], 3) ;
        }

        return $resultAfter;
    }

    function getLojaQueryCategoria($queryParams){
        $calculos = "(6371*acos(cos(radians(".$queryParams["latitude"]."))*cos(radians(latitude))*cos(radians(longitude) - radians(".$queryParams['longitude']."))+sin(radians(".$queryParams["latitude"]."))*sin(radians(latitude))))";
        $sql = "SELECT id,nome,logotipo,telefone,entrada,saida,fcmToken,latitude,longitude,endereco,categoria,online,".$calculos." AS distancia FROM loja WHERE categoria = '".$queryParams['categoria']."' HAVING distancia <= ".$queryParams['distancia']." ORDER BY distancia";
        
        $resultado = $this->database->query($sql)->fetchAll();

        $resultAfter = array();

        for ($i = 0; $i < sizeof($resultado); $i++){
            $resultAfter[$i]['id'] = $resultado[$i]['id'];
            $resultAfter[$i]['nome'] = $resultado[$i]['nome'];
            $resultAfter[$i]['logotipo'] = $resultado[$i]['logotipo'];
            $resultAfter[$i]['telefone'] = $resultado[$i]['telefone'];
            $resultAfter[$i]['entrada'] = $resultado[$i]['entrada'];
            $resultAfter[$i]['saida'] = $resultado[$i]['saida'];
            $resultAfter[$i]['fcmToken'] = $resultado[$i]['fcmToken'];
            $resultAfter[$i]['latitude'] = $resultado[$i]['latitude'];
            $resultAfter[$i]['longitude'] = $resultado[$i]['longitude'];
            $resultAfter[$i]['endereco'] = $resultado[$i]['endereco'];
            $resultAfter[$i]['categoria'] = $resultado[$i]['categoria'];
            $resultAfter[$i]['online'] = $resultado[$i]['online'];
            $resultAfter[$i]['distancia'] =  round($resultado[$i]['distancia'], 3) ;
        }

        return $resultAfter;
    }


    //GET
    function pegarTodasAsLojas(){
        $resultado = $this->database->select("loja","*");
        return $resultado;
    }
    //GET
    function pegarTodasAsLojasComACategoria($categoria){
        $resultado = $this->database->select("loja","*", ['categoria'=>$categoria]);
        return $resultado;
    }
    //POST
    function criarLoja($json)
    {
        date_default_timezone_set( "Africa/Luanda");
        $json['dataDeCriacao'] = date('Y-m-d H:i:s');

        //inserir
        $insert = $this->database->insert("loja",
            [
                "nome"=> $json["nome"],
                "provincia"=> $json["provincia"],
                "municipio"=> $json["municipio"],
                "telefone"=> $json["telefone"],
                "senha"=> $json["senha"],
                "email"=> $json["email"],
                "NIF"=> $json["NIF"],
                "emailDono"=> $json["emailDono"],
                "telefoneDono"=> $json["telefoneDono"],
                "BIDono"=> $json["BIDono"],
                "kambaIdReceiver"=> $json["kambaIdReceiver"],
                "endereco"=> $json["endereco"],
                "categoria"=> $json["categoria"],
                "online"=> $json["online"],
                "dataDeCriacao"=> $json["dataDeCriacao"],
                "bloqueada"=> true
            ]);

        return $insert;
    }
    //POST
    function actualizarLoja($id, $json)
    {
        $resultado = $this->database->update("loja", $json
        /*[
            "nome"=> $json["nome"],
            "provicia"=> $json["provicia"],
            "municipio"=> $json["municipio"],
            "telefone"=> $json["telefone"],
            "senha"=> $json["senha"],
            "entrada"=> $json["entrada"],
            "saida"=> $json["saida"],
            "criacao"=> $json["criacao"],
            "email"=> $json["email"],
            "NIF"=> $json["NIF"],
            "emailDono"=> $json["emailDono"],
            "telefoneDono"=> $json["telefoneDono"],
            "BIDono"=> $json["BIDono"],
            "fcmToken"=> $json["fcmToken"],
            "kambaIdReceiver"=> $json["kambaIdReceiver"],
            "latitude"=> $json["latitude"],
            "longitude"=> $json["longitude"],
            "endereco"=> $json["endereco"],
            "categoria"=> $json["categoria"],
            "bloqueada"=> $json["bloqueada"],
            "online"=> $json["online"],
            "dataDeCriacao"=> $json["dataDeCriacao"]

        ]*/,
        [
            "id"=>$id,
        ]);

        return $resultado;
    }
    //POST
    function actualizarLogoDaLoja($id, $imagem)
    {
        $logotipo = uploadedImage($imagem, 'loja');
        $resultado = $this->database->update("loja",
            [
                "logotipo"=> $logotipo
            ],
            [
                "id"=>$id,
            ]);

        return $resultado;
    }
    //POST
    function estadoDeActividade($id, $json)
    {
        $resultado = $this->database->update("loja",
            [
                "online"=> $json["online"]
            ],
            [
                "id"=>$id,
            ]);

        return $resultado;
    }

}
