<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Администратор',
            'email' => 'admin@oss.ru',
            'role' => '1',
            'password' => Hash::make('2g%42Yw44'),
        ]);
    }
}
