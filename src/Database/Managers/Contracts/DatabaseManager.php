<?php

namespace Core\Database\Managers\Contracts;

interface DatabaseManager
{

    public function connect() :\PDO;

    public function query(string $query,$values = []);

    public function read($columns = "*",$filter = null);

    public function create($data);

    public function update($id,$data);

    public function delete($id);
    
}