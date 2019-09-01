<?php

namespace aplication\models;

use aplication\models\Conexao;
use aplication\helpers\ReturnStatusNotification;

/**
 * Classe com funções basicas.
 */
class Crud{

    private $con;

    public function __construct(){
        $this->con = new Conexao();
    }

    /**
     * $table = 'Nome da tabela da inserção'
     * $data = 'Array com chaves sendo a informação de coluna e valor sendo seu respectivo conteudo na tabela'
     */
    public function insert($table,$data){
        $resposta = new ReturnStatusNotification();

        $formato = self::format_array($data);
        if($formato['status']){
            $query = "INSERT INTO $table (".$formato['data']['colunas'] . ") values (".$formato['data']['valores'].");";
            $retorno = self::query($query);
            $resposta->set_status($retorno['status']);
            $resposta->set_mensagem_status($retorno['mensagem_status']);
            $resposta->set_data($retorno['data']);
        }else{
            $resposta->set_status(false);
            $resposta->set_mensagem_status('Não conseguiu formatar!');
        }
        return $resposta->get_notification();
    }

    /**
     * Função que formatará o array para inserts e updates
     */
    public function format_array($data){
        $col['colunas'] = implode(',',array_keys($data));
        $into = '';
        foreach (array_values($data) as $key => $value) {
            if(is_numeric($value)) $into .= $value.',';
            else $into .= '\''.$value.'\',';
        }
        $col['valores'] = substr($into, 0, -1);
        $resposta = new ReturnStatusNotification(true,'',$col);
        return $resposta->get_notification();
    }

    public function update(){}
    public function select_all(){}
    public function delete(){}

    /**
     * Função que chama a função query da conexao para executar todas as querys
     */
    public function query($query){
        $result = $this->con->query($query);
        $resposta = new ReturnStatusNotification();
        if($result['status'])
            $resposta->set_data($result['data']);
        else{
            $resposta->set_status(false);
            $resposta->set_mensagem_status($result['mensagem_status']);
            $resposta->set_data($result['data']);
        }
        return $resposta->get_notification();
    }
}