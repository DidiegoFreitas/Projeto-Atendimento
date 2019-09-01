<?php

namespace aplication\models;

use aplication\helpers\ReturnStatusNotification;

class Conexao{
    private $con;

    private function conectar(){
        $this->con = mysqli_connect("172.20.0.2", "root", "mydatabase", "project_db");

        if (!$this->con) {
            echo "Error: Unable to connect to MySQL." . PHP_EOL;
            echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
            echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
    }

    public function encerrar(){
        mysqli_close($this->con);
    }

    public function query($query){
        $resposta = new ReturnStatusNotification();
        self::conectar();
        $result = $this->con->query($query);
        if(is_bool($result)){
            if(!$result){
                $resposta->set_status(false);
                $resposta->set_mensagem_status('Não conseguiu executar a query!');
                $resposta->set_data($query);
            }
        }
        else{
            $registros = array();
            while($row = $result->fetch_assoc())
                $registros[] = $row;
            $resposta->set_data($registros);
        }
        self::encerrar();
        return $resposta->get_notification();
    }
}
