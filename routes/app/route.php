<?php
session_start();
ob_start();

$route = new Route;

class Route{

    private $routes;
    private $routes_authentication;

    public function __construct(){
        $this->initRoutes();
        $this->run($this->getURL());
    }

    public function initRoutes(){
        $this->routes['/'] = array('controllers'=>'indexController','action'=>'inicial');
        $this->routes['/login'] = array('controllers'=>'loginController','action'=>'autenticacao');
        $this->routes['/login/cadastro'] = array('controllers'=>'loginController','action'=>'cadastro');
        $this->routes['/login/verificacao'] = array('controllers'=>'loginController','action'=>'verificacao');

        $this->routes_authentication['/chat'] = array('controllers'=>'chatController','action'=>'index');
    }

    protected function run($url){
        if($url == '/logout'){
            unset($_SESSION['usuario']);
            header('Location: /login');
        }
        if(array_key_exists($url,$this->routes)){
            $class = "\\aplication\\controllers\\".$this->routes[$url]['controllers'];
            $controllers = new $class;
            $action = $this->routes[$url]['action'];
            $controllers->$action();
        }
        else if(array_key_exists($url,$this->routes_authentication)){
            if(isset($_SESSION['usuario'])){
                $class = "\\aplication\\controllers\\".$this->routes_authentication[$url]['controllers'];
                $controllers = new $class;
                $action = $this->routes_authentication[$url]['action'];
                $controllers->$action();
            }
            else header('Location: /login');
        }       
        else header('Location: /login');
    }

    public function getURL(){
        return parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
    }
}