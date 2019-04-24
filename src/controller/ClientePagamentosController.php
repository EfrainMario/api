<?php

require_once (__DIR__."/../model/dao/ClienteDao.php");
require_once (__DIR__."/../helpers/GeralHelper.php");

use Slim\Http\Request;
use Slim\Http\Response;

class ClienteController{
    private $clienteDao;
    private $request;
    private $response;
    private $args;

    public function __construct(Request $request, Response $response, array $args) {
        $this->clienteDao = new ClienteDao();
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;
    }    

    public function getClientes(){
        $queryParams = $this->request->getQueryParams();

        if ( $this->hasFilters($queryParams) ) {
            $resultado = $this->clienteDao->getClientesQuery($queryParams);
            return resultObject($resultado, $this->response);
                
        }else{
            $resultado = $this->clienteDao->getClientes();
            return resultArray($resultado, $this->response);
        }
    }
        
    public function getClientesID(){
        $id = $this->args['id'];

        $resultado = $this->clienteDao->getClientesID($id);

        return resultObject($resultado, $this->response);
    }

    public function postClientes(){
        $json = $this->request->getParsedBody();

        if ($json != null) {
                
            $resultado = $this->clienteDao->postClientes($json);
            return checkCountRowPost($resultado, $this->response);

        } else {
            return $this->response->withStatus(400);
        }
    }
    
    public function putClientes(){
        $json = $this->request->getParsedBody();
        $id = $this->args['id'];

        if ($json != null) {
                
            $resultado = $this->clienteDao->putClientes($id, $json);
            return checkCountRowPut($resultado, $this->response);

        } else {
            return $this->response->withStatus(400);
        }
        
    }
    
    public function deleteClientes(){
        $id = $this->args['id'];
                
        $resultado = $this->clienteDao->deleteClientes($id);

        if( $resultado->rowCount() > 0 ){
            return $this->response->withStatus(200);    
        }else{
            return $this->response->withStatus(404);        
        }

    }

    function hasFilters($queryParams){
        if ( $queryParams != null ) {
            
            if ( $queryParams['email'] != null && $queryParams['senha'] != null )
                return true;
            else
                return false;
        }else {
            return false;
        }    
    }
 
}    
    

?>