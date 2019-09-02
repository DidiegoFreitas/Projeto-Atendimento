<?php

namespace aplication\helpers;

use aplication\helpers\ReturnStatusNotification;
use Pusher;

class MensagemPusher{

    function __construct($channel = false,$event = false,$data = false){
        if($channel && $event && $data){
            $retorno = self::send($channel,$event,$data);
            $resposta = new ReturnStatusNotification($retorno['status'],$retorno['mensagem_status'],$retorno['data']);
            return $resposta->get_notification();
        }
    }

    public function send($channel,$event,$data){
        $resposta = new ReturnStatusNotification();

        if($channel != '' && $event != '' && count($data) > 0){
            require 'vendor/autoload.php';

            $app_id = '848966';
            $key = '3c8e93a6f7612e82df8c';
            $secret = 'ecffc69a6eb74b772b18';
    
            $options = array( 'cluster' => 'us2', 'useTLS' => true );
    
            $pusher = new Pusher\Pusher($key,$secret,$app_id,$options);
    
            $pusher->trigger($channel, $event, $data);
            $resposta->set_mensagem_status('Enviado ao Pusher');
            $resposta->set_data($data);
        }else{
            $resposta->set_status(false);
            $resposta->set_mensagem_status('Parametros não adequados');
            $resposta->set_data(array('channel'=>$channel,'event'=>$event,'data'=>$data));
        }
        return $resposta->get_notification();
    }

    public function padrao_mensagem($nome_origem,$id_origem,$id_destino,$conteudo,$date = false){
        $resposta = new ReturnStatusNotification();

        if($id_origem && $id_destino && $conteudo != ''){
            if(!$date) $date = date('Y-m-d H:i:s');
            $send = array(
                'origem' => $id_origem,
                'nome_origem' => $nome_origem,
                'destino' => $id_destino,
                'mensagem' => $conteudo,
                'data_envio' => $date
            );
            $resposta->set_data($send);
        }else{
            $resposta->set_status(false);
            $resposta->set_mensagem_status('Parametros não adequados');
            $resposta->set_data(array('id_origem'=>$id_origem,'id_destino'=>$id_destino,'conteudo'=>$conteudo,'date'=>((!$date)?null:$date)));
        }
        return $resposta->get_notification();
    }
}
