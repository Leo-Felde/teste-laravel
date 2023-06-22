<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* Aqui são declaradas as rotas dos Endpoints no projeto.*/

/* Os endpoints declarados abaixo necessitam de autenticação, isso é, um usário precisa estar logado para que possa utiliza-los */
Route::middleware('auth:api')->group(function () {
    Route::group(['prefix' => 'usuarios'], function () {
        Route::get('/carregar/{id}', [UserController::class, 'carregar']);
        Route::get('/listar', [UserController::class, 'listar']);
    });

});

/* Diferente dos endpoints acima, estes estão fora do middleware de autenticação, portanto, não é necessário estar logado para utiliza-los */

Route::group(['prefix' => 'auth'], function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});