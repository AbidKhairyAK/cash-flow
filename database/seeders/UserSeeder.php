<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	User::truncate();
		User::create([
			'name' => 'Ir. Muh. Amin',
			'email' => 'amin@gmail.com',
			'password' => bcrypt('123456'),
            'role' => 'admin'
		]);
        User::create([
            'name' => 'Ariani',
            'email' => 'ariani@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 'admin'
        ]);
        User::create([
            'name' => 'Muhammad Abid Khairy',
            'email' => 'abid@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 'employee'
        ]);
        User::create([
            'name' => 'Abdur Rahman Huaidi',
            'email' => 'abdu@gmail.com',
            'password' => bcrypt('123456'),
            'role' => 'employee'
        ]);
    }
}
