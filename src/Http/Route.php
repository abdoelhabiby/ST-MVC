<?php

namespace Core\Http;

use Core\Http\Request;
use Core\Http\Response;
use Exception;

class Route
{
    protected static array $routes;

    public Request $request;
    public Response $response;

    public function __construct($request, $response)
    {
        $this->request = $request;
        $this->response = $response;
    }







    /**
     * $name --> string
     * $action mean what the class and method 
     * callable -> like function(){}
     * array -> [class,method]
     * string -> 'Class @ method'
     * 
     */

    public static function get($route, $action)
    {

        self::$routes['get'][$route] = $action;
    }//------end of mthod get----


    public static function post($route, $action)
    {

        self::$routes['post'][$route] = $action;
    }//------end of mthod post----


    public static function getRoutes()
    {
        return self::$routes;
    }//end of method get routes


    //----------------------------------


    public function resolver()
    {
        $path = $this->request->getPath();
        $method = $this->request->getRequestMethod();

        //--------check method request is exist in routes------
        if (array_key_exists($method, $this->getRoutes())) {

            $method_paths =  $this->getRoutes()[$method];

            //--------check path request is exist in routes method----

            if (array_key_exists($path, $method_paths)) {


                $action = $method_paths[$path];

                if(is_callable($action)){

                   return $this->whereIfActionCallable($action);

                }
                
                if(is_array($action)){

                   return $this->whereIfActionArray($action);

                }
                
                if(is_string($action)){

                   return $this->whereIfActionString($action);

                }

                
                dd('404');

            }


            //------show page erro 404 not found ----

            $message = "this path [ " . $path . " ]" . " not found";

            return error_404();
            return throw new Exception($message);
        }

        $message = "this method [ " . $method . " ]" . " not allowed";

        //  throw new Exception($message);

         return error_404();


    }  //--------end of method resolver


    private function whereIfActionCallable(callable $action)
    {

        return call_user_func_array($action,[]);

    } //-------end of method whereIfActionCallable--
    
    
    private function whereIfActionArray(array $action)
    {

        $parameters = $this->request->getParameters();
        
        return call_user_func_array([new $action[0],$action[1]],[]);

    } //-------end of method whereIfActionArray--


    private function whereIfActionString(string $action)
    {

        if (str_contains($action, '@')) {

               $handel = explode("@",$action,2);
               
               return call_user_func_array([new $handel[0],$handel[1]],[]);

        }

        // return $action;

    } //-------end of method whereIfActionString--


}//--end of class 
