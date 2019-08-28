<?php
include 'aplication/controllers/indexController.php';

$route = new Route;

class Route{
    private $routes;

    public function __construct(){
        $this->initRoutes();
        $this->run($this->getURL());
    }
    public function initRoutes(){
        $this->routes['/'] = array('controllers'=>'indexController','action'=>'indexFunction');
        $this->routes['/chat'] = array('controllers'=>'indexController','action'=>'chatFunction');
    }
    protected function run($url){
        if(array_key_exists($url,$this->routes)){
            $class = "\\aplication\\controllers\\".$this->routes[$url]['controllers'];
            $controllers = new $class;
            $action = $this->routes[$url]['action'];
            $controllers->$action();
        }else echo 'Rota nao existente';
    }
    public function getURL(){
        return parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
    }
}