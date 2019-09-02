<?php

namespace aplication\models;

use aplication\models\Crud;
use aplication\helpers\ReturnStatusNotification;

class Mensagem{
    const TABLE = 'mensagens';

    private $crud;
    private $id;
    private $id_relacionamento;
    private $id_envia;
    private $id_recebe;
    private $data_mensagem;
    private $conteudo;

    private $status;


    function __construct($id_relacionamento = false,$id_envia = false,$id_recebe = false,$conteudo = false,$data_mensagem = false){
        $this->crud = new Crud();

        if($id_relacionamento && $id_envia && $id_recebe && $conteudo){
            $this->id_relacionamento = $id_relacionamento;
            $this->id_envia = $id_envia;
            $this->id_recebe = $id_recebe;
            $this->conteudo = $conteudo;
            $this->data_mensagem = $data_mensagem;
            self::salvar();
        }
    }

    public function salvar(){
        $data['id_relacionamento'] = $this->id_relacionamento;
        $data['id_envia'] = $this->id_envia;
        $data['id_recebe'] = $this->id_recebe;
        $data['conteudo'] = $this->conteudo;
        if($this->data_mensagem)
            $data['data_mensagem'] = $this->data_mensagem;

        $retorno = $this->crud->insert(self::TABLE,$data);

        $this->status = $retorno;

        $resposta = new ReturnStatusNotification($retorno['status'],$retorno['mensagem_status'],$retorno['data']);
        return $resposta->get_notification();
    }
    public function get_status(){
        return $this->status;
    }
}