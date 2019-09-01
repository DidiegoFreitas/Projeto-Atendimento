<?php

namespace aplication\controllers;

use aplication\models\Usuario;
use aplication\helpers\ReturnStatusNotification;

class chatController{

    public $header = 'aplication//templates//header.php';
    public $footer = 'aplication//templates//footer.php';
    public $title_page = 'Inicio';

    public function index(){
        include 'aplication//views//chat//index.php';
    }
}