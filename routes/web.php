<?php

use App\Events\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
//    $collection = collect([1, 2, 3]);
//    dd($collection->where('0' , '>', '0')->all());

    return view('welcome');
});

Route::post('send-message',function (Request $request){
    event(new Message($request->username, $request->message));
    return ['success' => true];
});
