<?php

namespace  Core;

use Core\Http\Route;
use Core\Database\DB;
use Core\Database\Managers\MySqlManager;
use Core\Database\Managers\SqlLiteManager;
use Core\Http\Request;
use Core\Http\Response;
use Core\helpers\Config;

class Application
{
    protected DB $db;
    protected Request $request;
    protected Response $response;
    protected Route $route;
    protected Config $config;

    public function __construct()
    {
        $this->request = new Request;
        $this->response = new Response;
        $this->route = new Route($this->request, $this->response);
        $this->config = new Config($this->loadConfigrationFiles());
        $this->db = new DB($this->getDatabaseDriver());
    }


    public function run()
    {
        echo $this->route->resolver();
    }


    public  function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
    }


    protected function getDatabaseDriver()
    {
        return match(env('DB_CONECTION')){
            "mysql" => new MySqlManager,
            default => new MySqlManager,
        
        };
    }


    public function loadConfigrationFiles()
    {


        foreach (scandir(config_path()) as $file) {

            if ($file == '.' || $file == '..') {
                continue;
            }

            $file_name = explode('.', $file)[0];

            yield  $file_name => require config_path() .  $file;
        }
    }




}
