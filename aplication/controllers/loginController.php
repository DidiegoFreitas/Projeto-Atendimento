<?php

namespace aplication\controllers;

use aplication\models\Usuario;
use aplication\helpers\ReturnStatusNotification;

class loginController{

    public function autenticacao(){
        include 'aplication//views//login//index.php';
    }

    public function verificacao(){
        $resposta = new ReturnStatusNotification();
        $data = (isset($_POST['data']))?$_POST['data']:false;
        if(!$data){
            $resposta->set_status(false);
            $resposta->set_mensagem_status('data não identificado!');
        }else if(count($data) == 0){
            $resposta->set_status(false);
            $resposta->set_mensagem_status('data está vasio!');
        }else{
            $form = array();
            foreach ($data as $key => $fields) 
                $form[$fields['name']] = $fields['value'];
            $usuario = new Usuario();
            $retorno = $usuario->verificacao($form['login'],$form['senha_login']);
            if($retorno['status']){
                unset($retorno['data'][0]['senha']);
                $_SESSION['usuario'] = $retorno['data'][0];
            }else{
                $resposta->set_status($retorno['status']);
                $resposta->set_mensagem_status($retorno['mensagem_status']);
                $resposta->set_data($retorno['data']);
            }
        }
        echo $resposta->get_notification(true);
    }

    public function cadastro(){
        $resposta = new ReturnStatusNotification();
        $data = (isset($_POST['data']))?$_POST['data']:false;
        if(!$data){
            $resposta->set_status(false);
            $resposta->set_mensagem_status('data não identificado!');
        }else if(count($data) == 0){
            $resposta->set_status(false);
            $resposta->set_mensagem_status('data está vasio!');
        }else{
            $form = array();
            foreach ($data as $key => $fields) 
                $form[0][$fields['name']] = $fields['value'];
            $usuario = new Usuario();
            $usuario->criar($form,0);
            $retorno = $usuario->salvar();

            $resposta->set_status($retorno['status']);
            $resposta->set_mensagem_status($retorno['mensagem_status']);
            $resposta->set_data($retorno['data']);
        }
        echo $resposta->get_notification(true);
    }

    public function destroy_session(){
        session_destroy();
    }
}