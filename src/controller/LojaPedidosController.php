<?php

require_once (__DIR__."/../model/dao/PedidosDao.php");
require_once (__DIR__."/../helpers/GeralHelper.php");

use Slim\Http\Request;
use Slim\Http\Response;

class LojaPedidosController{
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

    public function getLojaPedidos(){
        $idLoja = $this->args['id'];
        $parametros = $this->request->getParams();
        $resultado = $this->pedidosDao->getLojaPedidos($idLoja, $parametros);

        return resultArray($resultado, $this->response);
    }

    public function getLojaPedidosID(){
        $id = $this->args['id'];
        $idPedido = $this->args['_id'];
                
        $resultado = $this->pedidosDao->getLojaPedidosID($idPedido, $id);

        return resultObject($resultado, $this->response);
    }

    public function postLojaPedidosID(){
        $idPedido = $this->args['id'];
        $jsonArray = $this->request->getParsedBody();

        if($jsonArray!=null){

            $resultado = $this->pedidosDao->postLojaPedidos($idPedido,$jsonArray);

            return checkCountRowPost($resultado, $this->response);
        } else {
            return $this->response->withStatus(400);
        }
    }
    public function putLojaPedidosID(){
        $idLoja = $this->args['id'];
        $idPedido = $this->args['_id'];
        $jsonArray = $this->request->getParsedBody();

        if($jsonArray!=null){

            $resultado = $this->pedidosDao->putLojaPedidosID($idPedido, $idLoja, $jsonArray);

            return checkCountRowPost($resultado, $this->response);
        } else {
            return $this->response->withStatus(400);
        }
    }

}    
    
