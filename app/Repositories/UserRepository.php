<?php


namespace App\Repositories;


use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function store(array $attributes)
    {
        $attributes['password'] = Hash::make($attributes['password']);
        return $this->user->create($attributes);
    }

    public function findByEmail($email)
    {
        return $this->user->whereEmail($email)->first();
    }

    public function update(array $attributes, $user)
    {

        $user->name = '';
        $user->email = $attributes['email'];
        $user->phone_number = $attributes['phone_number'];

        $user->save();

        return $user;
    }

    public function updatePassword(array $attributes, $user)
    {
        if (password_verify($attributes['current_password'], $user->password)) {
            $user->password = Hash::make($attributes['password']);
            $user->save();
            return $user;
        } else {
            return false;
        }
    }

    public function delete($user)
    {
        return $user->delete();
    }

    public function findById($id)
    {
        return $this->user->whereId($id)->firstOrFail();
    }
}
