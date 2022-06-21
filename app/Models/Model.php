<?php

namespace App\Models;

use Core\helpers\Str;


abstract class Model
{
    
protected static $instance; //to take instance name from the class will used this abstract 

public static function create(array $data)
{

    self::$instance = static::class;

    return app()->db->create($data);
}

// -----------------------------------------
public static function all()
{

    self::$instance = static::class;

    return app()->db->read();
}
// -----------------------------------------
public static function where($filter,$columns = '*')
{

    self::$instance = static::class;

    return app()->db->read($columns, $filter);
}
// -----------------------------------------
public static  function getModel()
{
    return self::$instance;
}
// -----------------------------------------

public static  function getTableName()
{
   
    $name =strtolower(end(explode("\\",static::class)));
    return  Str::plural($name);
}

// -----------------------------------------
// -----------------------------------------
// -----------------------------------------


} //--------------end of abstract class---------
