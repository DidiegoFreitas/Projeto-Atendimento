<?php

namespace aplication\controllers;

use aplication\models\Usuario;
use aplication\helpers\ReturnStatusNotification;
use aplication\helpers\MensagemPusher;

class chatController{

    public $header = 'aplication//templates//header.php';
    public $footer = 'aplication//templates//footer.php';
    public $title_page = 'Inicio';

    public function index(){
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
    public function sendMensagem(){
        var_dump($_POST);
        //$send = new MensagemPusher();

        # code...
    }
}