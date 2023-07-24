<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {

    $env = App::Environment();

    if(App::Environment('local')){
        echo 'Environment is local';
    }
    else{
        echo 'Environment is '.$env;
    }

    exit();

    return view('welcome');
});
