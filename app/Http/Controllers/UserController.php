<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Services\UserService;


class UserController extends Controller
{
  public function carregar(Request $request, string $id, UserService $userService)
  {
      return $userService->findOne($id);
  }
}
