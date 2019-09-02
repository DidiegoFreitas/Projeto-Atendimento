<?php

namespace aplication\Models;

use aplication\models\Crud;
use aplication\helpers\ReturnStatusNotification;

class Usuario{
    const MIN_CHARACTER_NOME = 3;
    const MAX_CHARACTER_NOME = 30;
    const MAX_CHARACTER_EMAIL = 50;
    const MAX_CHARACTER_TEL = 15;
    const TABLE = 'usuario';
    
    private $crud;
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $telefone;
    private $id_permissao;

    function __construct($id = false){
        $this->crud = new Crud();
        if($id) self::buscar_id($id);
    }

    public function get_info(){
        $resposta = new ReturnStatusNotification();
        $resposta->set_data(array(
            'id' => $this->id,
            'nome'  => $this->nome,
            'email'  => $this->email,
            'telefone'  => $this->telefone,
            'id_permissao'  => $this->id_permissao,
        ));
        return $resposta->get_notification();
    }
    public function get_id(){
        return $this->id;
    }
    public function get_nome(){
        return $this->nome;
    }
    public function get_email(){
        return $this->email;
    }
    public function get_telefone(){
        return $this->telefone;
    }
    public function get_id_permissao(){
        return $this->id_permissaoe;
    }

    /**
     * Validação dos campos para inserção e atualizações de usuarios
     */
    public function validate($id,$data,$id_permissao){
        $retorno = new ReturnStatusNotification();
        $error = array();
        if(self::MIN_CHARACTER_NOME > strlen($data['nome']) || self::MAX_CHARACTER_NOME < strlen($data['nome'])){
            $retorno->set_status(false);
            $error['nome'] = 'O nome precisa ter de '.self::MIN_CHARACTER_NOME.' ate '.self::MAX_CHARACTER_NOME.' caracteres!';
        }
        if(self::MAX_CHARACTER_EMAIL < strlen($data['email'])){
            $retorno->set_status(false);
            $error['email'] = 'O email poder ter até '.self::MAX_CHARACTER_EMAIL;
        }
        if(self::buscar_email($data['email'],$id)['status']){
            $retorno->set_status(false);
            $error['email'] = 'Este email já esta cadastrado!';
        }
        if(strlen(self::format_tel($data['telefone'])) > self::MAX_CHARACTER_TEL){
            $retorno->set_status(false);
            $error['telefone'] = 'Este número tem mais de '.self::MAX_CHARACTER_TEL.' caracteres!';
        }
        if($id_permissao != 1 && strlen(self::format_tel($data['telefone'])) == 0){
            $retorno->set_status(false);
            $error['telefone'] = 'Este campo é obrigatório!';
        }
        if($data['senha'] != $data['conf_senha']){
            $retorno->set_status(false);
            $error['senha'] = 'Senhas não conferem!';
            $error['conf_senha'] = 'Senhas não conferem!';
        }
        $retorno->set_data($error);
        return $retorno->get_notification();
    }

    /**
     * Função para remover caracteres especiais da mascara do campo telefone
     */
    public function format_tel($telefone){
        $array_replace = array('(',')',' ','-');
        return str_replace($array_replace,'',$telefone);
    }

    public function criar($data,$id_permissao = 0){
        foreach ($data as $key => $value) {
            $resposta = self::validate($key,$value,$id_permissao);
            if(!$resposta['status'])
                return $resposta;
            else{
                $this->nome = $value['nome'];
                $this->email = $value['email'];
                $this->senha = md5($value['senha']);
                $this->telefone = self::format_tel($value['telefone']);
                $this->id_permissao = ($id_permissao == 1)?2:3;
                $resposta = new ReturnStatusNotification();
                return $resposta->get_notification();
            }
        }
    }

    public function salvar(){
        $data['nome'] = $this->nome;
        $data['email'] = $this->email;
        $data['senha'] = $this->senha;
        $data['telefone'] = $this->telefone;
        $data['id_permissao'] = $this->id_permissao;
        $retorno = $this->crud->insert(self::TABLE,$data);

        $resposta = new ReturnStatusNotification($retorno['status'],$retorno['mensagem_status'],$retorno['data']);
        return $resposta->get_notification();
    }

    /**
     * Função que busca um usuario e alimenta objeto
     */
    public function buscar_id($id){
        $resposta = new ReturnStatusNotification();
        $query = "SELECT id,nome,email,senha,telefone,id_permissao FROM usuario WHERE id = $id;";

        $result = $this->crud->query($query);
        if($result['status'] && count($result['data']) > 0){
            foreach ($result['data'] as $key => $value) {
                $this->id = $value['id'];
                $this->nome = $value['nome'];
                $this->email = $value['email'];
                $this->senha = null;
                $this->telefone = $value['telefone'];
                $this->id_permissao = $value['id_permissao'];
            }
        }else{
            $resposta->set_status(false);
            $resposta->set_mensagem_status('Não encontrado!');
        }
        return $resposta->get_notification();
    }

    public function buscar_email($email,$id_ignorar){
        $resposta = new ReturnStatusNotification();
        $query = "SELECT id,nome,email,telefone,id_permissao FROM usuario WHERE email = '$email' AND id <> $id_ignorar;";
        $result = $this->crud->query($query);
        if($result['status'] && count($result['data']) > 0){
            foreach ($result['data'] as $key => $value) {
                $this->id = $value['id'];
                $this->nome = $value['nome'];
                $this->email = $value['email'];
                $this->senha = null;
                $this->telefone = $value['telefone'];
                $this->id_permissao = $value['id_permissao'];
            }
        }else{
            $resposta->set_status(false);
            $resposta->set_mensagem_status('Não encontrado!');
        }
        return $resposta->get_notification();
    }

    public function buscar_clientes(){
        $resposta = new ReturnStatusNotification();

        $query = "SELECT R.id_atendente,R.id_cliente,C.nome as nome_cliente FROM relacionamentos R LEFT JOIN usuario C ON(C.id = R.id_cliente) WHERE R.id_atendente = $this->id";
        $result = $this->crud->query($query);
        if($result['status'] && count($result['data']) > 0)
            $resposta->set_data($result['data']);
        else{
            $resposta->set_status(false);
            $resposta->set_mensagem_status('Nenhum cliente!');
        }
        return $resposta->get_notification();
    }

    public function buscar_conversa($id_atendente,$id_cliente){
        $resposta = new ReturnStatusNotification();
        $query = "SELECT M.*,U.nome FROM mensagens M LEFT JOIN usuario U ON(U.id = M.id_envia) WHERE M.id_relacionamento = (SELECT R.id FROM relacionamentos R WHERE R.id_atendente = $id_atendente AND R.id_cliente = $id_cliente) ORDER BY M.data_mensagem;";
        $result = $this->crud->query($query);
        if($result['status'] && count($result['data']) > 0)
            $resposta->set_data($result['data']);
        else{
            $resposta->set_status(false);
            $resposta->set_mensagem_status('Nenhuma conversa!');
        }
        return $resposta->get_notification();
    }

    public function buscar_conversa_cliente($id_cliente){
        $resposta = new ReturnStatusNotification();
        $query = "SELECT M.*,U.nome FROM mensagens M LEFT JOIN usuario U ON(U.id = M.id_envia) WHERE M.id_relacionamento = (SELECT R.id FROM relacionamentos R WHERE R.id_cliente = $id_cliente) ORDER BY M.data_mensagem;";
        $result = $this->crud->query($query);
        if($result['status'] && count($result['data']) > 0)
            $resposta->set_data($result['data']);
        else{
            $resposta->set_status(false);
            $resposta->set_mensagem_status('Nenhuma mensagem!');
        }
        return $resposta->get_notification();
    }

    public function lista(){
        $resposta = new ReturnStatusNotification();
        $query = "SELECT U.id,U.nome,COUNT(R.id) AS qtd FROM usuario U LEFT JOIN relacionamentos R ON(U.id = R.id_atendente) WHERE id_permissao = 2 GROUP BY U.id,U.nome";
        $result = $this->crud->query($query);
        if($result['status'] && count($result['data']) > 0){
            $resposta->set_data($result['data']);
        }else{
            $resposta->set_status(false);
            $resposta->set_mensagem_status('Não encontrado!');
        }
        return $resposta->get_notification();
    }

    public function verificacao($email,$senha){
        $resposta = new ReturnStatusNotification();
        $query = "SELECT * FROM usuario WHERE email = '$email' AND senha = '".md5($senha)."';";
        $retorno = $this->crud->query($query);
        if($retorno['status']){
            if(!count($retorno['data']) > 0){
                $resposta->set_status(false);
                $resposta->set_mensagem_status('Usuario não encontrado!');
                $resposta->set_data($retorno['data']);
            }else $resposta->set_data($retorno['data']);
        }else{
            $resposta->set_status($retorno['status']);
            $resposta->set_mensagem_status($retorno['mensagem_status']);
            $resposta->set_data($retorno['data']);
        }
        return $resposta->get_notification();
    }
}
