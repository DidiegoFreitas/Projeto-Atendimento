<?php

namespace aplication\Controllers;

class indexController{

    const dir_template = 'aplication//templates//';
    const dir_view = 'aplication//views//index//';
    const template_view = 'template.php';
    protected $view;
    protected $cdn_js_view;
    protected $cdn_css_view;
    
    public function indexFunction(){
        $this->render('index.php',self::template_view);
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
            $this->cdn_css_view = self::dir_view . 'cdn//cdn_css.php';
            $this->cdn_js_view = self::dir_view . 'cdn//cdn_js.php';
        }else {
            $this->cdn_css_view = false;
            $this->cdn_js_view = false;
        }
        include self::dir_template . $template;
    }
}