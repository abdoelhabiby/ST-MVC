<?php

namespace Core\Database\Grammers;

use App\Models\Model;

class MySqlGrammer
{

    public static function insertQuery($data)
    {
        $tabel_name ="users"; // Model::getTableName() ;
        $keys = array_keys($data);

        $columns = ' (`' . implode('`,' . '`', $keys) . '`)';


        $questions = array_map(function ($value) {
            return ":" .$value;
        }, $keys);
        
        $questions = "(" . implode(",", $questions) . ")";
        
        return "INSERT INTO " . $tabel_name . $columns . " VALUES " . $questions;
    }





    public static function selectQuery($columns, $filter)

    {
        $tabel_name ="users"; // Model::getTableName() ;

        if (is_array($columns)) {
            $columns = count($columns) > 1 ?  implode(',', $columns)  : $columns[0];
        }

        if ($filter && is_array($filter)) {
            $filter = " WHERE "  . $filter[0] . " " . $filter[1] . " ?";
        } else {
            $filter = " ";
        }

        $query = "SELECT " . $columns . " FROM " . $tabel_name . $filter;
        return $query;
    }


    // --------------------------------------------------------------------
    // --------------------------------------------------------------------

    public static function deleteQuery($id)
    {
        $tabel_name ="users"; // Model::getTableName() ;

        $query = "DELETE FROM " . $tabel_name. " WHERE id =:id";
        return $query;
    }
    // --------------------------------------------------------------------
    public static function updateQuery($id, $data)
    {
        $tabel_name ="users"; // Model::getTableName() ;
        $columns = '';

        foreach ($data as $key => $value) {
            $sepa = $key != array_key_last($data) ? " , " : '';
            $columns .= $key . "=:" . $key . $sepa;
        }

        $query = "UPDATE " . $tabel_name . " SET " . $columns . " WHERE id =:id ";

        return $query;
    }

    // --------------------------------------------------------------------
    // --------------------------------------------------------------------
    // --------------------------------------------------------------------




}
