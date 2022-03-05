<?php

namespace  Core;

use Core\Http\Request;
use Core\Http\Response;
use Core\Http\Route;

class Application
{
    protected $request;
    protected $response;
    protected $route;

    public function __construct()
    {
        $this->request = new Request;
        $this->response = new Response;
        $this->route = new Route($this->request,$this->response);
    }


    public function run()
    {
        echo $this->route->resolver();
    }


    public  function __get($name)
    {
        if(property_exists($this,$name)){
            return $this->$name;
        }
    }
}
