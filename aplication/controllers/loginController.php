<?php

namespace aplication\Controllers;

//echo '<pre>';
//var_dump($_SESSION);
class loginController{

    public function indexFunction(){
        include 'aplication//views//login//index.php';

        //$this->render('index.php',self::template_view,true);
    }
/*
    public function chatFunction(){
        $this->render('chat.php',self::template_view,true);
    }
    public function sendFunction(){
        var_dump('teste');
    }

    public function content_cdn(){
        include self::dir_template . 'cdn_css.php';
        include self::dir_template . 'cdn_js.php';
    }

    public function content_cdn_view(){
        if($this->cdn_css_view) include $this->cdn_css_view;
        if($this->cdn_js_view) include $this->cdn_js_view;
    }

    public function content(){
        include $this->view;
    }

    public function render($view,$template,$cdn = false){
        $this->view = self::dir_view . $view;
        if($cdn){
            $this->cdn_css_view = (file_exists(self::dir_view . 'cdn//cdn_css.php')?self::dir_view . 'cdn//cdn_css.php':false);
            $this->cdn_js_view = (file_exists(self::dir_view . 'cdn//cdn_js.php')?self::dir_view . 'cdn//cdn_js.php':false);
        }else {
            $this->cdn_css_view = false;
            $this->cdn_js_view = false;
        }
        include self::dir_template . $template;
    }
    */
}