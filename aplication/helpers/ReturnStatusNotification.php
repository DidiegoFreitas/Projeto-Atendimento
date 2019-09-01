<?php

namespace aplication\helpers;

class ReturnStatusNotification{
    private $status;
    private $mensagem_status;
    private $data;

    function __construct($status = true,$mensagem_status = '',$data = array()){
        $this->status = $status;
        $this->mensagem_status = $mensagem_status;
        $this->data = $data;
    }
    
    public function set_status($status){
        $this->status = $status;
    }
    public function set_mensagem_status($mensagem_status){
        $this->mensagem_status = $mensagem_status;
    }
    public function set_data($data){
        $this->data = $data;
    }

    public function get_status(){
        return $this->status;
    }
    public function get_mensagem_status(){
        return $this->mensagem_status;
    }
    public function get_data(){
        return $this->data;
    }
    public function get_notification($json = false){
        $data['status'] = $this->status;
        $data['mensagem_status'] = $this->mensagem_status;
        $data['data'] = $this->data;
        if(!$json) return $data;
        else return json_encode($data);
    }
}
