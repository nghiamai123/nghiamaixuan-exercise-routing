<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/user')->group(function () {

    Route::get('/', function () {
        global $users;
        return $users;
    });

    Route::get('/{userid}', function (int $userid = 0) {
        global $users;

        if ($userid >= 0 && $userid < count($users)) {
            $user = $users[$userid];
            return $user;
        } else {

            return 'If cannot find the user with index: ' . $userid;
        }
    })->where('userid', '[0-9]+');;

    Route::get('/{userIndex}', function (string $username) {
        global $users;
        for ($i = 0; $i < count($users); $i++) {
            if ($users[$i]['name'] == $username) {
                return $users[$i];
            }
        }
        return redirect()->route('geterr', $username);
    });

    Route::get('/{userIndex}/post/{postIndex}', function (int $userIndex, string $postIndex) {
        global $users;
        // echo count($users);
        for ($i = 0; $i < count($users); $i++) {
            if ($i == $userIndex) {
                if ($postIndex >= 0 && $postIndex < count($users[$i]['posts'])) {
                    return $users[$i]['posts'][$postIndex];
                } else {
                    return "Cannot find the post with id $postIndex for user $userIndex";
                }
            }
        }
        return "Cannot find the post with id $postIndex for user $userIndex";
    });
});

Route::get('{any}', function () {
    return '<b>You cannot get a User like this !</b>';
})->name('geterr');
