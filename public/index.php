<?php

session_start();

use Core\View\View;
use App\Models\User;
use Core\Application;
use Core\Http\Route;
use Core\helpers\Str;
use Core\helpers\Hash;
use Core\Http\Request;
use Core\Http\Response;
use Core\helpers\Config;
use Core\helpers\ArrayHelper;
use Core\Database\Managers\MySqlManager;
use Core\helpers\Session;

require_once "../vendor/autoload.php";


require_once "../routes/web.php";


$dotenv = Dotenv\Dotenv::createMutable(__DIR__ . "/../", ".env");
$dotenv->load();

$array = [
    "database" => [
        "default" => 'mysql',
        "connection" => [
            "mysql" => [
                "dbname" => 'mvc',
                "username" => 'root',
                "password" => ''
            ]
        ]
    ]
];


$session =new Session;



$value = $_SESSION['messages_flash'];



dd($value);



app()->run();
