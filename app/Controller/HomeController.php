<?php

namespace App\Controller;

use Core\helpers\ArrayHelper;

class HomeController
{

    public function index()
    {

        $params = [
            "title" => "home page",
            "navbar" => ["lists" => [1, 2, 3, 4, 5,]],
            "admin" => ["id" => 2, "name" => 'ahmed', 'email' => 'exampel@example.com']
        ];

        return view('home.index', $params);
        
    }

    public function home()
    {
        return "hello world from " . $this::class . " method home ";
    }
}
