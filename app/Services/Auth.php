<?php

namespace App\Services;

use App\Models\User;

class Auth
{
    protected $userModel;
    public function __construct()
    {
        $this->userModel = new User();
    }

    public function login($username, $password)
    {
        $existing = $this->userModel->where('username', $username)->where('status', true)->first();
        if (!$existing) {
            return [
                'success' => false,
                'message' => 'Username atau password salah',
            ];
        }

        if (!$existing->status) {
            return [
                'success' => false,
                'message' => 'Akun tidak aktif, silahkan lapor ke admin',
            ];
        }

        if (!password_verify($password, $existing->password)) {
            return [
                'success' => false,
                'message' => 'Username atau password salah',
            ];
        }

        session()->set([
            'user_id'   => $existing->id,
            'name'      => $existing->name,
            'username'  => $existing->username,
            'role_id'   => $existing->role_id,
            'logged_in' => true,
        ]);

        return [
            'success' => true,
            'message' => 'Selamat datang ' . $existing->name,
        ];
    }

    public function logout()
    {
        session()->destroy();
    }
}
