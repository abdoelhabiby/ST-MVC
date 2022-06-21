<?php 

return [

    "default" => env('DB_CONECTION','mysql'),




    "connection" => [
        "mysql" => [
            "dbhost" => env('DB_HOST','localhost'),
            "dbname" => env('DB_NAME','mvc'),
            "username" => env('DB_USERNAME','root'),
            "password" => env('BD_PASSWORD','')
        ]
    ]


];