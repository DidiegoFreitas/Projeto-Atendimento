<?php 

namespace aplication\models;

use aplication\models\Crud;
use aplication\models\Usuario;
use aplication\helpers\ReturnStatusNotification;


class Relacionamentos{
    const TABLE = 'relacionamentos';

    private $id;
    private $id_atendente;
    private $id_cliente;
    private $crud;


    function __construct($id_atendente = false,$id_cliente = false){
        $this->crud = new Crud();
        if($id_atendente && $id_cliente){
            $this->id_atendente = $id_atendente;
            $this->id_cliente = $id_cliente;
            self::busca_relacionamento();
        }
    }

    public function criar($id_atendente,$id_cliente){
        $resposta = new ReturnStatusNotification();
        $this->crud = new Crud();

        $data = array(
            'id_atendente' => $id_atendente,
            'id_cliente' => $id_cliente
        );
        
        $retorno = $this->crud->insert(self::TABLE,$data);
        if($retorno['status']){
            $this->id_atendente = $id_atendente;
            $this->id_cliente = $id_cliente;
            $relacionamento = self::busca_relacionamento();
            if($relacionamento['status'])
                $this->id = $relacionamento['data'][0]['id'];
            $resposta->set_status($relacionamento['status']);
            $resposta->set_mensagem_status($relacionamento['mensagem_status']);
            $resposta->set_data($relacionamento['data']);
        }
        return $resposta->get_notification();
    }

    public function buscar_atendente(){
        $resposta = new ReturnStatusNotification();
        $obj = new Usuario();
        $retorno = $obj->lista();
        if($retorno['status']){
            $menor = 0;
            $user_escolhido = array();
            foreach ($retorno['data'] as $key => $value) {
                if(!$key){
                    $menor = $value['qtd'];
                    $user_escolhido = $value;
                }
                if($menor > $value['qtd']){
                    $menor = $value['qtd'];
                    $user_escolhido = $value;
                } 
            }
            $resposta->set_data($user_escolhido);
        }else{
            $resposta->set_status($retorno['status']);
            $resposta->set_mensagem_status($retorno['mensagem_status']);
            $resposta->set_data($retorno['data']);
        }
        return $resposta->get_notification();
    }

    public function get_id(){
        return $this->id;
    }
    public function busca_relacionamento(){
        $resposta = new ReturnStatusNotification();
        $query = "SELECT * FROM " . self::TABLE . " WHERE id_atendente = $this->id_atendente AND id_cliente = $this->id_cliente;";
        $retorno = $this->crud->query($query);

        if($retorno['status'] && count($retorno['data']) > 0){
            $this->id = $retorno['data'][0]['id'];
            $resposta->set_data($retorno['data']);
        }else{
            $resposta->set_status(false);
            $resposta->set_mensagem_status('Não encontrado!');
        }
        return $resposta->get_notification();
    }
    
}
