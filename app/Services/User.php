<?php
namespace App\Services;

use App\User as UserModel;

class User
{
    static public function make($role = 'asesi', $nama, $email, $password, $data)
    {
        return UserModel::create([
            'nama' => $nama,
            'email' => $email,
            'password' => bcrypt($password),
            'data' => $data,
            'role' => $role,
            'ttd' => null,
        ]);
    }
}