<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    // return view('welcome');
    global $users;
    return $users;
});

Route::get('/users', function () {
    // return view('welcome');
    global $users;
    $AllUsers = array();
    for($i = 0; $i < count($users); $i++){
        $AllUsers[$i] = $users[$i]['name'];
    }
    return "the user are: " . implode(', ', $AllUsers);
});
