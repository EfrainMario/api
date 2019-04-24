<?php

require_once (__DIR__."/../model/dao/PedidosDao.php");
require_once (__DIR__."/../helpers/GeralHelper.php");

use Slim\Http\Request;
use Slim\Http\Response;

class ClientePedidosController{
    private $pedidosDao;
    private $request;
    private $response;
    private $args;

    public function __construct(Request $request, Response $response, array $args) {
        $this->pedidosDao = new PedidosDao();
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;
    }

    public function getClientePedidos(){
        $id = $this->args['id'];
                
        $resultado = $this->pedidosDao->getClientePedidos($id);

        return resultArray($resultado, $this->response);
    }

    public function getClientePedidosID(){
        $id = $this->args['id'];
        $idPedido = $this->args['_id'];
                
        $resultado = $this->pedidosDao->getClientePedidosID($idPedido, $id);

        return resultObject($resultado, $this->response);
    }

    public function postClientePedidos(){
        $json = $this->request->getParsedBody();
        $id = $this->args['id'];

        if( hasID($this->pedidosDao->database,"cliente",$id) ){
            if ($json != null) {    
                $resultado = $this->pedidosDao->postClientePedidos($id ,$json);
                return checkCountRowPost($resultado, $this->response);
    
            } else {
                return $this->response->withStatus(400);
            }

        }else{
            return $this->response->withStatus(404);
        }
        
    }

    public function putClientePedidos(){
        $json = $this->request->getParsedBody();
        $idPedido = $this->args['_id'];

        if ($json != null) {  
            $resultado = $this->pedidosDao->putClientePedidos($idPedido, $json);
            return checkCountRowPut($resultado, $this->response);

        } else {
            return $this->response->withStatus(400);
        }
        
    } 
 
}    
    

?>