<?php

namespace aplication\controllers;

use aplication\models\Usuario;
use aplication\models\Mensagem;
use aplication\models\Relacionamentos;
use aplication\helpers\ReturnStatusNotification;
use aplication\helpers\MensagemPusher;

class chatController{

    public $header = 'aplication//templates//header.php';
    public $footer = 'aplication//templates//footer.php';
    public $title_page = 'Inicio';

    public function index(){
        if($_SESSION['usuario']['id_permissao'] == 3)
            include 'aplication//views//chat//index_cliente.php';
        else
            include 'aplication//views//chat//index.php';
    }

    public function get_user(){
        $resposta = new ReturnStatusNotification();
        $user = new Usuario($_SESSION['usuario']['id']);
        $resposta->set_data(
            array(
                'usuario' => $user->get_info(),
                'clientes' => $user->buscar_clientes()
            ));

        echo $resposta->get_notification(true);
    }

    public function get_conversa(){
        $id_atendente = (isset($_POST['id_atendente']))?$_POST['id_atendente']:false;
        $id_cliente = (isset($_POST['id_cliente']))?$_POST['id_cliente']:false;
        $obj = new Usuario();
        $retorno = $obj->buscar_conversa($id_atendente,$id_cliente);
        
        $resposta = new ReturnStatusNotification($retorno['status'],$retorno['mensagem_status'],$retorno['data']);

        echo $resposta->get_notification(true);
    }

    public function get_conversa_cliente(){
        $id_cliente = (isset($_POST['id_cliente']))?$_POST['id_cliente']:false;
        $obj = new Usuario();
        $retorno = $obj->buscar_conversa_cliente($id_cliente);
        
        $resposta = new ReturnStatusNotification($retorno['status'],$retorno['mensagem_status'],$retorno['data']);

        echo $resposta->get_notification(true);
    }

    public function sendMensagem(){
        $resposta = new ReturnStatusNotification();

        $origem = (isset($_POST['origem']))?$_POST['origem']:false;
        $destino = (isset($_POST['destino']))?$_POST['destino']:false;
        $mensagem = (isset($_POST['mensagem']))?$_POST['mensagem']:false;
        if($origem && $destino && $mensagem){
            $send = new MensagemPusher();
            $obj_user = new Usuario($origem);
            $retorno = $send->padrao_mensagem($obj_user->get_nome(),$origem,$destino,$mensagem);
            if($retorno['status']){

                if($_SESSION['usuario']['id_permissao'] == 3){
                    if($origem == $_SESSION['usuario']['id']){
                        $id_atendente = $destino;
                        $id_cliente = $origem;
                    }
                    else if($destino == $_SESSION['usuario']['id']){
                        $id_atendente = $origem;
                        $id_cliente = $destino;
                    }
                }else{
                    if($origem == $_SESSION['usuario']['id']){
                        $id_atendente = $origem;
                        $id_cliente = $destino;
                    }
                    else if($destino == $_SESSION['usuario']['id']){
                        $id_atendente = $destino;
                        $id_cliente = $origem;
                    }
                }

                $obj_relacionameto = new Relacionamentos($id_atendente,$id_cliente);

                $obj_mensagem = new Mensagem($obj_relacionameto->get_id(),$origem,$destino,$mensagem,$retorno['data']['data_envio']);
                $retorno_obj = $obj_mensagem->get_status();
                if($retorno_obj['status'])
                    $retorno_send = $send->send('channel_'.$destino,'mensagem-channel',$retorno['data']);
                $resposta->set_status($retorno_send['status']);
                $resposta->set_mensagem_status($retorno_send['mensagem_status']);
                $resposta->set_data($retorno_send['data']);
            }else{
                $resposta->set_status($retorno['status']);
                $resposta->set_mensagem_status($retorno['mensagem_status']);
                $resposta->set_data($retorno['data']);
            }
        }else{
            $resposta->set_status(false);
            $resposta->set_mensagem_status('Faltando campo!');
            $resposta->set_data(array('origem'=>$origem,'destino'=>$destino,'mensagem'=>$mensagem));
        }
        echo $resposta->get_notification(true);
    }

    public function sendPrimeiraMensagem(){
        $resposta = new ReturnStatusNotification();

        $origem = (isset($_POST['origem']))?$_POST['origem']:false;
        $mensagem = (isset($_POST['mensagem']))?$_POST['mensagem']:false;
        if($origem && $mensagem){
            $obj_relacionamento = new Relacionamentos();
            $atendente_escolhido = $obj_relacionamento->buscar_atendente();
            if($atendente_escolhido['status']){
                $retorno = $obj_relacionamento->criar($atendente_escolhido['data']['id'],$origem);
                if($retorno['status']){
                    $send = new MensagemPusher();
                    $obj_user = new Usuario($origem);
                    $retorno = $send->padrao_mensagem($obj_user->get_nome(),$origem,$atendente_escolhido['data']['id'],$mensagem);
                    if($retorno['status']){
                        $obj_mensagem = new Mensagem($obj_relacionamento->get_id(),$origem,$atendente_escolhido['data']['id'],$mensagem,$retorno['data']['data_envio']);
                        $retorno_obj = $obj_mensagem->get_status();
                        if($retorno_obj['status'])
                            $retorno_send = $send->send('channel_'.$atendente_escolhido['data']['id'],'new-cliente-channel',$retorno['data']);
                        $resposta->set_status($retorno_send['status']);
                        $resposta->set_mensagem_status($retorno_send['mensagem_status']);
                        $resposta->set_data($retorno_send['data']);
                    }else{
                        $resposta->set_status($retorno['status']);
                        $resposta->set_mensagem_status($retorno['mensagem_status']);
                        $resposta->set_data($retorno['data']);
                    }
                }else{
                    $resposta->set_status($retorno['status']);
                    $resposta->set_mensagem_status($retorno['mensagem_status']);
                    $resposta->set_data($retorno['data']);
                }
            }else{
                $resposta->set_status($atendente_escolhido['status']);
                $resposta->set_mensagem_status($atendente_escolhido['mensagem_status']);
                $resposta->set_data($atendente_escolhido['data']);
            }
        }else{
            $resposta->set_status(false);
            $resposta->set_mensagem_status('Faltando campo!');
            $resposta->set_data(array('origem'=>$origem,'mensagem'=>$mensagem));
        }
        echo $resposta->get_notification(true);
    }
}