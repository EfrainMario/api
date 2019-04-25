<?php
/**
 * Created by PhpStorm.
 * User: candido
 * Date: 18/08/2018
 * Time: 14:40
 */

require_once (__DIR__."/../ConexaoBD.php");
require_once (__DIR__."/../../helpers/GeralHelper.php");


class LojaAvaliacoesDao
{
    private $database;

    public function __construct()
    {
        $conexao = new ConexaoBD();
        $this->database = $conexao->database;

    }

    //GET
    function pegarAvaliacaoMediaDaLoja($idLoja){
        $resultadoCount = $this->database->count("avaliacaoLoja",
            [
                'idLoja' => $idLoja
            ]);
        if($resultadoCount > 29){

            $resultado = $this->database->avg("avaliacaoLoja","rating",
                [
                    'idLoja' => $idLoja
                ]);
            return $resultado;
        }

        return null;

    }

}
