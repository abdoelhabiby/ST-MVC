<?php

use Core\Application;
use Core\helpers\Hash;

// ------------------------------------------
// ------------------------------------------
// ----------------config--------------------
if (!function_exists('config')) {

    function config($key = null,$default = null)
    {
        if(is_null($key)){
            return app()->config;

        }

        if(is_array($key)){
            
            return config()->set($key);
        }

        return config()->get($key,$default);
    }

}
// ------------------------------------------
// ------------------------------------------
// ------------------------------------------
// ------------------------------------------
//-----------------app---------------
//-----------------app---------------

if (!function_exists('app')) {
    function app()
    {
       static $instance = null;

       if(!$instance){
         $instance = new  Application();
       }

       return $instance;
    }
}

//----------------------------------------
//-------------base_path---------------

use Core\View\View;

if (!function_exists('base_path')) {
    function base_path()
    {
        return dirname(__DIR__) . DS . '..' . DS;
    }
}


//-------------------------------
//-------------------------------
if (!function_exists('config_path')) {
    function config_path()
    {
        return base_path() . 'config' . DS;
    }
}


//-------------------------------
//-------------------------------

if (!function_exists('bcrypt')) {
    function bcrypt($pass)
    {

       return Hash::make($pass);
    }
}

//-------------------------------
//-------------env---------------

if (!function_exists('env')) {
    function env($key, $default = null)
    {

        return $_ENV[$key] ?? $default;
    }
}


// ---------------------------------------

//-------------view_path---------------

if (!function_exists('view_path')) {
    function view_path()
    {

        return base_path() . 'views' . DS;
    }
}

// ---------------------------------------

if (!function_exists('config_path')) {
    function config_path()
    {

        return base_path() . 'config' . DS;
    }
}

// ---------------------------------------



if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}
// ---------------------------------------

//-------------view---------------

if (!function_exists('view')) {

    function view($view, $paramas = [])
    {

        return View::make($view, $paramas);
    }
}
// ---------------------------------------

//-------------include_file---------------

if (!function_exists('include_file')) {

    function include_file($file_name, $params = [])
    {

        if (file_exists($file_name)) {

            foreach ($params as $key => $value) {
                $$key = $value;
            }


            ob_start();

            include $file_name;

            return ob_get_clean();
        } else {

            return throw new Exception('file ' . $file_name . " dosent exist");
        }
    }
}

// ---------------------------------------

if (!function_exists('error_404')) {

    function error_404()
    {

        $file_name = view_path() . "errors" . DS . '404.blade.php';

        if (file_exists($file_name)) {

        

            ob_start();

            include $file_name;

            return ob_get_clean();
        } else {

            return throw new Exception('file ' . $file_name . " dosent exist");
        }
    }
}

// ---------------------------------------
if (!function_exists('value')) {

    function value($value)
    {


        return ($value instanceof Closure) ? $value() : $value;
    }
}

// ---------------------------------------
// ---------------------------------------
if (!function_exists('convertStringContean')) {

    function convertStringContean($value)
    {


        return ($value instanceof Closure) ? $value() : $value;
    }
}

// ---------------------------------------
// ---------------------------------------
// ---------------------------------------
// ---------------------------------------