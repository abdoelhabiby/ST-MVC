<?php

use Core\helpers\ArrayHelper;
use Core\View\View;
use Core\Http\Route;
use Core\Http\Request;
use Core\Http\Response;

require_once "../vendor/autoload.php";


require_once "../routes/web.php";


$dotenv = Dotenv\Dotenv::createMutable(__DIR__ . "/../", ".env");
$dotenv->load();




$array = [
    "front" => 'tttt',
    "web",
    "dashboard" => [
        "admins" => [
            "index" => ['testo'], "create", "update"
        ],
        "users" => [
            "index", "create", "update"
        ]
    ]
];




//----we need to now the admin has data..

$key = "dashboard.admins";


$get = ArrayHelper::get($array,$key);

dd($get);



//first check if the key existin first keys

if (ArrayHelper::exists($array, $key)) {
    dd($array[$key]);
}

//else take this key and explode by separetir (.) if i needed search by parts

$parts = explode('.', $key);

$sub_array = $array;

// if (count($parts) > 1) {


//     foreach ($parts as $part) {

//         if (ArrayHelper::exists($sub_array, $part) || ArrayHelper::accessible($sub_array[$part])) {

//             $sub_array = $sub_array[$part];
//         } else {
//             return false;
//         }
//     }

//     dd($sub_array);
// } else {
//     return false;
// }



app()->run();
