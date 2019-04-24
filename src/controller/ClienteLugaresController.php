<?php

require_once (__DIR__."/../model/dao/LugarClienteDao.php");
require_once (__DIR__."/../helpers/GeralHelper.php");

use Slim\Http\Request;
use Slim\Http\Response;

class ClienteLugaresController{
    private $lugarClienteDao;
    private $request;
    private $response;
    private $args;

    public function __construct(Request $request, Response $response, array $args) {
        $this->lugarClienteDao = new LugarClienteDao();
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;
    }   
    
    public function getClienteLugares(){
        $id = $this->args['id'];
                
        $resultado = $this->lugarClienteDao->getClienteLugares($id);

        return resultArray($resultado, $this->response);
    }

    public function getClienteLugaresID(){
        $id = $this->args['id'];
        $idLugar = $this->args['_id'];
                
        $resultado = $this->lugarClienteDao->getClienteLugaresID($idLugar, $id);

        return resultObject($resultado, $this->response);
    }

    public function postClienteLugares(){
        $json = $this->request->getParsedBody();
        $id = $this->args['id'];

        if( hasID($pedidosDao->database,"cliente",$id) ){

            if ($json != null) {
                $resultado = $this->lugarClienteDao->postClienteLugares($id ,$json);
                return checkCountRowPost($resultado, $this->response);

            } else {
                return $this->response->withStatus(400);
            }
        }else{
            return $this->response->withStatus(404);
        }
    }

    public function putClienteLugares(){
        $json = $this->request->getParsedBody();
        $idLugar = $this->args['_id'];

        if ($json != null) {
                
            $resultado = $this->lugarClienteDao->putClienteLugares($idLugar, $json);
            return checkCountRowPut($resultado, $this->response);

        } else {
            return $this->response->withStatus(400);
        }
        
    }

    public function deleteClienteLugares(){
        //Falta isso...
        
    }

}    
    

?>