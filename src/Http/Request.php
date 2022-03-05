<?php

namespace Core\Http;


class Request
{



    protected  array $parameters = [];
    protected string $path;


    public function __construct()
    {
        $this->resolveUrl();
    }


    public function getRequestMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    } //-----------end of method getRequestMethod    

    private function resolveUrl()

    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';


        if (str_contains($path, '?')) {

            $path_with_parameters =  explode('?', $path, 2);
            $path = $path_with_parameters[0];

            $this->path = $path;


            $parameters = $this->handelStringParametersToArray($path_with_parameters[1]);

          

            $this->parameters = $parameters;
        }else{
            
            $this->path = $path;

        }



    } //----------end class resolve path------


    public function getPath()
    {

        return $this->path;
    } //-----------end of get path------- 

    public function getParameters()
    {

        return $this->parameters;
    } //-----------end of get Parameters-------




    public function handelStringParametersToArray(string $parameter) : array
    {

        $explode_parameters = explode('&', $parameter);

        $parameters = [];


        foreach ($explode_parameters as $parameter) {

            $par = explode("=", $parameter);

            if (!empty($par[0])) {

                $parameters[$par[0]] = isset($par[1]) ? $par[1] :  "";
            }
        }

        return $parameters;


    } //----------end of method handelStringParametersToArray--------



}//----end of classs
