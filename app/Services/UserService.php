<?php


namespace App\Services;


use App\Repositories\UserRepository;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function storeUser($attribute)
    {
        return $this->userRepository->store($attribute);
    }

    public function login($attributes)
    {
        return $this->userRepository->findByEmail($attributes['email']);

    }

}
