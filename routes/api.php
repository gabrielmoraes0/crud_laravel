<?php

use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/users', function (Request $request) {
//     return response()->json([
//         'status' => true,
//         'message' => 'Listar Usuários',
//     ],200);
// });

Route::get('/users',[UserController::class, 'index']);

Route::get('/users/{user}',[UserController::class, 'show']);