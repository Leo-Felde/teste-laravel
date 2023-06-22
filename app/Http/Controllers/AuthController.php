<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\UserService;


class AuthController extends Controller
{
    public function register(Request $request, UserService $userService)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        return $userService->save($request->only(['name', 'email', 'password']));
    }

    public function login(Request $request, UserService $userService)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        return $userService->login($request->only(['email', 'password']));
    }
}
