<?php

use Illuminate\Database\Seeder;
use App\Services\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::make('admin', 'Example Admin', 'admin@mail.com', 'password', []);
        User::make('asesi', 'Example Asesi', 'asesi@mail.com', 'password', []);
        User::make('asesor', 'Example Asesor', 'asesor@mail.com', 'password', []);
        User::make('superadmin', 'Example Superadmin', 'superadmin@mail.com', 'password', []);
    }
}
