<?php

require_once (__DIR__."/../model/dao/ProdutoDao.php");
require_once (__DIR__."/../helpers/GeralHelper.php");

use Slim\Http\Request;
use Slim\Http\Response;

class LojaProdutosController{
    private $produtoDao;
    private $request;
    private $response;
    private $args;

    public function __construct(Request $request, Response $response, array $args) {
        $this->produtoDao = new ProdutoDao();
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;
    }

    public function getLojaProdutos(){
        $idLoja = $this->args['id'];
        $queryParams = $this->request->getQueryParams();
        
        if ($this->hasFiltersName($queryParams)) {
            $resultado = $this->produtoDao->getLojaProdutosPeloNome($idLoja, $queryParams['nome']);
            return resultArray($resultado, $this->response);
        } else {
            $resultado = $this->produtoDao->pegarProdutosDaLoja($idLoja);
            return resultArray($resultado, $this->response);
        }
          
    }

    public function getLojaProdutoID(){
        $idLoja = $this->args['id'];
        $idProduto = $this->args['_id'];
                
        $resultado = $this->produtoDao->getLojaProdutoPeloId($idLoja, $idProduto);

        return resultObject($resultado, $this->response);
    } 

    //POST
    function postLojaProduto(){
        //Falta fazer aquela verificacao do id
        //Da loja, o que vai atrasar demasiado
        //A resposta...
         //var_dump($this->request->getUploadedFiles());

        $idLoja = $this->args['id'];

        $imagem = $_FILES['imagem'];
        $json = json_decode($this->request->getParam('json'), true);
        var_dump($json);

        $json['imagem'] = uploadedImage($imagem, 'produto');
        var_dump($json);
        $resultado = $this->produtoDao->postLojaProduto($idLoja, $json);
        return checkCountRowPost($resultado, $this->response);
        
    }
    //POST
    function postLojaProdutoImagem(){
        //Falta fazer aquela verificacao do id
        //Da loja, o que vai atrasar demasiado
        //A resposta...

        $idLoja = $this->args['id'];
        $idProduto = $this->args['_id'];
        $resultado =null;

        if(isset($_FILES['imagem'])){
            $imagem = uploadedImage($_FILES['imagem'], 'produto');
            if($imagem){
                $resultado = $this->produtoDao->putLojaProduto($idProduto, $idLoja, ['imagem' => $imagem]);
            }
        }
        return checkCountRowPost($resultado, $this->response);

    }

    //PUT
    function putLojaProduto(){
        $idLoja = $this->args['id'];
        $idProduto = $this->args['_id'];

        $json = $this->request->getParsedBody();
        $resultado = $this->produtoDao->putLojaProduto($idProduto, $idLoja, $json);
        return checkCountRowPut($resultado, $this->response);
    }
    
    
    //DELETE
    function deleteLojaProduto(){
        $idLoja = $this->args['id'];
        $idProduto = $this->args['_id'];
                
        $resultado = $this->produtoDao->deleteLojaProduto($idProduto, $idLoja);

        if( $resultado->rowCount() > 0 ){
            return $this->response->withStatus(200);    
        }else{
            return $this->response->withStatus(404);        
        }
    }

    private function hasFiltersName($queryParams){
        if ( $queryParams != null ) {
            
            if ( $queryParams['nome' != null])
                return true;
            else
                return false;

        }else {
            return false;
        } 
    }
 
}    
    

?>