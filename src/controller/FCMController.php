<?php

require_once (__DIR__."/../model/dao/FCMDao.php");

use Slim\Http\Request;
use Slim\Http\Response;

class FCMController{
    private $fcmDao;
    private $request;
    private $response;
    private $args;

    public function __construct(Request $request, Response $response, array $args) {
        $this->fcmDao = new FCMDao();
        $this->request = $request;
        $this->response = $response;
        $this->args = $args;

        /*checkAuthorizationOfWriteRequest($request->isPost());
        checkAuthorizationToAcessResource($args['id'], $_GET['id'], $this->response);*/
    }

    public function sendToClienteById(){
        
        $json = $this->request->getParsedBody();
        $idCliente = $this->args['id'];
        $data = $json['data'];
        $notification = $json['notification'];

        if( $data != null && $notification != null){

            $tokenCliente = $this->fcmDao->getClienteTokenById($idCliente)[0];

            if($tokenCliente != null){

                $message = array( "data" => $data, "notification" => $notification, "to" => $tokenCliente);
                return $this->sendToFCM($message, $this->response);

            }else{
                return $this->response->withStatus(204);
            }

        }else{
            return $this->response->withStatus(400);
        }

    }

    public function sendToClienteByToken(){
        
        $json = $this->request->getParsedBody();
        $tokenCliente = $this->args['token'];
        $data = $json['data'];
        $notification = $json['notification'];

        if( $data != null && $notification != null){

            $message = array( "data" => $data, "notification" => $notification, "to" => $tokenCliente);
            return $this->sendToFCM($message, $this->response);
                
        }else{
            return $this->response->withStatus(400);
        }

    }

    public function sendToLojaById(){
        
        $json = $this->request->getParsedBody();
        $idLoja = $this->args['id'];
        $data = $json['data'];
        $notification = $json['notification'];

        if( $data != null && $notification != null){

            $tokenLoja = $this->fcmDao->getLojaTokenById($idLoja)[0];

            if($tokenLoja != null){

                $message = array( "data" => $data, "notification" => $notification, "to" => $tokenLoja);
                return $this->sendToFCM($message, $this->response);

            }else{
                return $this->response->withStatus(204);
            }

        }else{
            return $this->response->withStatus(400);
        }

    }

    public function sendToLojaByToken(){
        
        $json = $this->request->getParsedBody();
        $tokenLoja = $this->args['token'];
        $data = $json['data'];
        $notification = $json['notification'];

        if( $data != null && $notification != null){

            $message = array( "data" => $data, "notification" => $notification, "to" => $tokenLoja);
            return $this->sendToFCM($message, $this->response);

        }else{
            return $this->response->withStatus(400);
        }

    }


    function sendToFCM($message, Response $response){

        $url = 'https://fcm.googleapis.com/fcm/send';

        $server_key = "AAAA7Y_M5Zk:APA91bFFIK5TKwG14ERF7KBX6gIH4pMstdMX213KwhcpcNvJaSwMkX9D6xgvHny_hbpJTlswkE9BB87AbCWshmXnqAwdrniAhWn89mWBoJ00wKnkne9XhlJNbAaBNxMHUxWYOhwtIWIK";

        $headers = array(
            'Content-Type:application/json',
            'Authorization:key='.$server_key
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));
        $result = curl_exec($ch);

        if ($result === FALSE) {
            return $response->withStatus(503,''.curl_error($ch));
        }

        curl_close($ch);

        $re = json_decode($result);

        if ($re->success >= 1){
            return $response->withStatus(200);
        }else{
            return $response->withStatus(503, $re->failure);
        }

    }
 
}