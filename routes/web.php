<?php

use Core\Http\Route;
use App\Controller\HomeController;

Route::get('/home',HomeController::class . "@index");

Route::post('/home','HomeController@store');

Route::get('/admin','AdminController@index');
Route::post('/admin','AdminController@store');