<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// $app->get('/', function () use ($app) {
//     return $app->version();
// });
$app->post('auth/login',['uses' => 'UserController@authenticate']);
$app->post('user/rollback',['uses' => 'UserController@rollback']);
$app->group(['middleware' => 'jwt.auth'],function() use ($app) {
        $app->get('users', function() {
            $users = \App\User::all();
            return response()->json($users);
        });
    }
);
