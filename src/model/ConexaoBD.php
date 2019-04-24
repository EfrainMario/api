<?php
/**
 * Created by PhpStorm.
 * User: candido
 * Date: 16/08/2018
 * Time: 23:06
 */

require_once (__DIR__."/Medoo.php");


class ConexaoBD
{

    public $database;

    //remove esse comentario quando for para testar no servidor
    //E comenta igualzinho o outro bloco de codigo
    //Nunca se esquece, never forget
    /*public function __construct()
    {
        $this->database = new \Medoo\Medoo([
            'database_type' => 'pgsql',
            'database_name' => 'd3t02ak65j2pmh',
            'server' => 'ec2-184-73-222-192.compute-1.amazonaws.com',
            'username' => 'cjegurmtepqeln',
            'password' => '9b2ce3b2579880154c9474b58e681ee3847448882b74082334102dbded359426',
            'charset' => 'utf8']);
    }*/


    //Esse bloco aqui é para comentar, antes de enviar para o servidor
    public function __construct()
    {
        /*$this->database = new \Medoo\Medoo([
            'database_type' => 'mysql',
            'database_name' => 'vectisfood',
            'server' => 'localhost',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8']);*/
        $this->database = new \Medoo\Medoo([
            'database_type' => 'mysql',
            'database_name' => 'lnYToa7J9Y',
            'server' => 'remotemysql.com',
            'username' => 'lnYToa7J9Y',
            'password' => 'z1DplIjphX',
            'charset' => 'utf8']);
    }

}
