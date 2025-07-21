<?php

class App {
    protected $controller = "Home";
    protected $method = "index";
    protected $params = [];
    protected $url;
    public function __construct() {
        $this->url = $this->parseUrl();
        $this->routing();
    }

    public function parseUrl(){
        if(isset($_GET['url'])){
            $url = rtrim($_GET['url'], '/');//clear the end of '/'
            $url = preg_replace("/[^a-zA-Z0-9 \/]/", "", $url);
            $url = explode('/', $url);
            return $url;
        } else {
            return $url = [$this->controller];
        }
    }

    public function routing() {
        //check controller
        if(file_exists("../app/controllers/".$this->url[0].".php")) {
            $this->controller = $this->url[0];
            unset($this->url);
        }

        //initialized controller 
        require_once "../app/controllers/".$this->controller.".php";
        $this->controller = new $this->controller;
        
        //check method
        if(isset($this->url[1]) && method_exists($this->controller, $this->url[1])) {
            $this->method = $this->url[1];
            unset($this->url);
        }

        //check params
        if(!empty($this->url)) {
            $this->params = array_values($this->url);
        }

        call_user_func_array([$this->controller, $this->method], $this->params);

    }
}