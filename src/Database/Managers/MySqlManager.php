<?php

namespace Core\Database\Managers;

use Core\Database\Grammers\MySqlGrammer;
use PDO;
use Core\Database\Managers\Contracts\DatabaseManager;

class MySqlManager implements DatabaseManager
{

    protected static  $connect;

    public function connect(): PDO
    {
        if (!self::$connect) {

            try {



                $servername = config('database.connection.mysql.dbhost');
                $dbname = config('database.connection.mysql.dbname');
                $username = config('database.connection.mysql.username');
                $password = config('database.connection.mysql.password');

                self::$connect = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                // set the PDO error mode to exception
                self::$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);



                // echo "Connected successfully";
            } catch (\PDOException $e) {
                dd($e);
                // echo "Connection failed: " . $e->getMessage();
            }
        }

        return self::$connect;
    }
    // --------------------------------------------------
    public function query(string $query, $values = [])
    {
        try {

            $stm = self::$connect->prepare($query);

            if (in_array("*", $values)) {
                $get = array_search("*", $values);
                unset($values[$get]);
            }

             $stm->execute($values);

             return  $stm;

            return $stm->rowCount();
        } catch (\PDOException $th) {

            return $th->getMessage();
        }
    }
    // --------------------------------------------------
    public function read($columns = "*", $filter = null)
    {
        $query = MySqlGrammer::selectQuery($columns, $filter);
        $columns = (array) $columns;

        $read = $this->query($query, $columns);

        return $read->fetchAll(PDO::FETCH_ASSOC);
    }
    // --------------------------------------------------
    public function create($data)
    {
        $query = MySqlGrammer::insertQuery($data);

        $insert = $this->query($query, $data);

        return $insert;
    }
    // --------------------------------------------------
    public function update($id, $data)
    {
        $query = MySqlGrammer::updateQuery($id, $data);

        $data['id'] = $id;

        $update = $this->query($query, $data);
        return $update;
    }
    // --------------------------------------------------
    public function delete($id)
    {
        $query = MySqlGrammer::deleteQuery($id);

        $delete = $this->query($query, ['id' => $id]);

        return $delete;
    }
    // --------------------------------------------------
}
