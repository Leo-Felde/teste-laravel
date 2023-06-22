<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\BaseService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class UserService extends BaseService
{
  private $userRepository;

  public function __construct(
    Request $request,
    UserRepository $userRepository
  )
  {
      parent::__construct($request);
      $this->userRepository = $userRepository;
  }

  public function login($body)
  {
    $credentials = [
      'email' => $body['email'],
      'password' => $body['password']
    ];

    try {
      if (!$token = JWTAuth::attempt($credentials)) {
          return $this->responseNotFound(trans('messages.auth.failed'));
      }
    } catch (JWTException $e) {
        return $this->responseServerError(trans('messages.auth.jwt_failed'));
    }

    $user = JWTAuth::user();
    return $this->responseSuccess([
        'usuario' => $user,
        'token' => $user->createToken("API TOKEN")->plainTextToken
    ]);
  }

  public function save($body)
  {
    try {
        DB::beginTransaction();
        $user;

        // Caso seja informado um ID no body edita os dados do usuário de ID correspondente
        if (isset($body['id'])) {
          $user = $this->userRepository->findOneById($body['id']);
          if (!$usuario) {
              return $this->responseNotFound(trans('messages.user.not_found'));
          }

          $user->fill($body);
        } else { // se não informado um ID, cadastra um novo usuário com os dados informados
          $emailExiste = $this->userRepository->getByEmail($body['email']);
          if ($emailExiste) { // impede de cadastrar usuários com e-mails iguais
              return $this->responseNotAcceptable(trans('messages.auth.invalid_email'));
          }

          $body['password'] = Hash::make($body['password']);
          $user = $this->userRepository->create($body);
        }
        $this->userRepository->save($user);
        DB::commit();
        
        return $this->responseCreated(trans(isset($body['id']) ? 'messages.user.edited' : 'messages.auth.created'));
    } catch (\Exception $e) {
        DB::rollBack();
        return $this->responseFailure($e);
    }
  }
}