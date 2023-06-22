<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

class UserRepository extends BaseRepository
{
    function __construct()
    {
        $this->model = $this->resolveModel(User::class);
    }

    public function getByEmail($email): ?User
    {
        return $this->model
            ->select('*')
            ->where('email', $email)
            ->first();
    }

    public function findOneById(string $id)
    {
        return $this->model
            ->select('*')
            ->where('id', $id)
            ->first();
    }

    public function findAll()
    {
        return $this->model
            ->select('*')
            ->get();
    }
}
