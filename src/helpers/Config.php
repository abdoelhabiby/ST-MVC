<?php

namespace Core\helpers;


class Config implements \ArrayAccess
{

    protected array $items = [];



    public function __construct($items)
    {
        foreach ($items as $key => $item) {

            $this->items[$key] = $item;
        }
    }


    //------------------all---------------------


    public function all()
    {
        return $this->items;
    }

    //-----------------------------------




    public function offsetExists(mixed $offset)
    {
        return $this->exist($offset);
    }
    // -----------------------------------------

    public function offsetGet(mixed $offset)
    {
        return $this->get($offset);
    }

    // -----------------------------------------
    public function offsetSet(mixed $offset, mixed $value)
    {
        return $this->set($offset, $value);
    }

    // -----------------------------------------

    public function offsetUnset(mixed $offset)
    {

        return $this->set($offset, null);
    }
    // -----------------------------------------




    // will recive like this database.default
    public  function get($offset, $default = null)
    {


        if (is_array($offset)) {
           
            return $this->getMany($offset);
        }

        if (!str_contains($offset, '.')) {

            return ArrayHelper::get($this->items, $offset, $default);
        }



        return ArrayHelper::get($this->items, $offset, $default);
    }

    // -----------------------------------------
    public function getMany($offsets)
    {
        $results = [];


        foreach ($offsets as $key =>  $value) {
            
          
            // $get = $this->get($offset);

            if (is_numeric($key)) { // mean giving the target within default value
               
                $get = $this->get($value);
                $key = $value;

                if(str_contains($value,'.')){
                    $key = end(explode('.',$value));
                }
                
                $results[$key] = $get;
            } else {
                // meean the key it will be target and value it will be devault value
                $get = $this->get($key, $value);

                if (str_contains($key, '.')) {
                    $key = end(explode('.', $key));
                }

                $results[$key] = $get;
            }
        }

        return $results;
    }
    // -----------------------------------------
    public  function set($key, $value = null)
    {



        if (is_array($key)) {


            return $this->setMany($key);
        }

        //----second parameter need to be listed by separaitor

        return ArrayHelper::set($this->items, $key, $value);

    }
    // -----------------------------------------
    // -----------------------------------------

    public function setMany(array $array)
    {

        $results = [];


        foreach ($array as $key =>  $value) {
            // $get = $this->get($offset);

            if (is_numeric($key)) { // mean dosnt giving the key
                
                continue;
                // $get = $this->set($value);
                // $results[$value] = $get;

            } else {
                // meean the key it will be target and value it will be devault value
                $set = $this->set($key, $value);


                if (str_contains($key, '.')) {
                    $key = end(explode('.', $key));
                }

                $results[$key] = $set[$key] ?? $value;
            }
        }

        return $results;
    }
    // -----------------------------------------


    public  function exist(string $key)
    {
        return $this->get($key, null) ? true : false;
    }



    // -----------------------------------------
    // -----------------------------------------
    // -----------------------------------------
    // -----------------------------------------
    // -----------------------------------------
    // -----------------------------------------

}
