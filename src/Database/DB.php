<?php

namespace Core\Database;

use Core\Database\Concerns\ConectsTo;
use Core\Database\Managers\Contracts\DatabaseManager;

class DB
{

    protected DatabaseManager $manager;

    public function __construct($manager)
    {
        $this->manager = $manager;
        // $this->init();
    }

    // ----------------------------------------------------

    public function init()
    {
        ConectsTo::connect($this->manager);
    }

    // ----------------------------------------------------

    protected function raw(string $query, $value)
    {
        return $this->manager->query($query, $value);
    }
    // ----------------------------------------------------


    protected function read($columns = '*', $filter = null)
    {
        return $this->manager->read($columns, $filter);
    }


    // ----------------------------------------------------
    protected function create(array $data)
    {
        return $this->manager->create($data);
    }
    // ----------------------------------------------------
    protected function update($id,array  $data)
    {
        return $this->manager->update($id, $data);
    }
    // ----------------------------------------------------
    protected function delete($id)
    {
        return $this->manager->delete($id);
    }
    // ----------------------------------------------------
    // ----------------------------------------------------

    public function __call($name, $arguments)
    {
        if(method_exists($this,$name)){
            return call_user_func_array([$this,$name],$arguments);
        }
    }



    // ----------------------------------------------------
    // ----------------------------------------------------

}
