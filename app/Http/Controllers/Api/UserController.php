<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id','desc')->paginate(1);
        return response()->json([
            'status' => true,
            'users' => $users,
        ], 200);
    }

    public function show(user $user)
    {
        return response()->json([
            'status' => true,
            'user' => $user,
        ], 200);
    }














}

