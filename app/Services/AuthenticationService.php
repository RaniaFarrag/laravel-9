<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthenticationService{

    public function createUser($data):User{
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);

        return $user;
    }
}
