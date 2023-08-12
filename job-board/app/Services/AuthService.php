<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthService extends BaseService
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }
    public function attemptLogin($email, $password, $remember = false)
    {
        $credentials = compact('email', 'password');

        if (Auth::attempt($credentials, $remember)) {
            return true;
        }

        return false;
    }
}
