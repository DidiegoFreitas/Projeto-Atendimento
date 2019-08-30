<?php
session_start();
ob_start();

include 'aplication/controllers/indexController.php';
include 'aplication/controllers/loginController.php';

$route = new Route;

class Route{
    private $routes;
    private $routes_authentication;

    public function __construct(){
        $this->initRoutes();
        $this->run($this->getURL());
    }
    public function initRoutes(){
        $this->routes['/'] = array('controllers'=>'indexController','action'=>'indexFunction');
        //$this->routes['/chat'] = array('controllers'=>'indexController','action'=>'chatFunction');

        $this->routes_authentication['/chat'] = array('controllers'=>'indexController','action'=>'chatFunction');
    }
    protected function run($url){
        if(array_key_exists($url,$this->routes)){
            $class = "\\aplication\\controllers\\".$this->routes[$url]['controllers'];
            $controllers = new $class;
            $action = $this->routes[$url]['action'];
            $controllers->$action();
        }
        else if(array_key_exists($url,$this->routes_authentication)){
            /*if(count($_SESSION)>0){
                $class = "\\aplication\\controllers\\".$this->routes_authentication[$url]['controllers'];
                $controllers = new $class;
                $action = $this->routes_authentication[$url]['action'];
                $controllers->$action();
            }else{
                */
                $_SESSION['usuario']=array('id'=>1,'nome'=>'Diego');
                $class = "\\aplication\\controllers\\loginController";
                $controllers = new $class;
                $controllers->indexFunction();

                //exit(header("Location: /login.php?auth=false"));
            //}
        }       
        else echo 'Rota nao existente';
    }
    public function getURL(){
        return parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
    }
}