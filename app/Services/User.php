<?php
namespace App\Services;

use App\User as UserModel;

class User
{
    static public function make($role = 'asesi', $nama, $email, $password, $data, $isBcrypt = false)
    {
        $data = self::validateData($role, $data);

        return UserModel::create([
            'nama' => $nama,
            'email' => $email,
            'password' => ($isBcrypt) ? $password : bcrypt($password),
            'data' => $data,
            'role' => $role,
            'ttd' => null,
        ]);
    }

    static public function validateData($user, $data)
    {
        $role = ($user instanceof \App\User ? $user->role : $user);
        $newData = ($user instanceof \App\User ? $user->data : $data);
        $rules = [];

        if ($role == 'admin')
        {
            $rules = ['ttd', 'nik'];
        } elseif ($role == 'asesor') {
            $rules = ['ttd', 'nik'];
        } elseif ($role == 'asesi') {
            $rules = ['ttd'];
        }

        // 
        $newData = (array) $newData;
        foreach ($rules as $item)
        {
            $newData[$item] = '';
        }
        $newData = (object) $newData;
        
        // 
        foreach ($data as $key => $value)
        {
            $newData->{$key} = $value;
        }

        return $newData;
    }
}