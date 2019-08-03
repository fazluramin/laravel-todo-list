<?php

use Illuminate\Database\Seeder;
use App\Models\Users;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Users::firstOrCreate([
            'full_name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'is_active' => 1,
            'password_reset_token' => str_random(60),
            'user_type_id' => 1
        ]);
        Users::firstOrCreate([
            'full_name' => 'Admin2',
            'email' => 'admin2@admin.com',
            'password' => bcrypt('admin'),
            'is_active' => 1,
            'password_reset_token' => str_random(60),
            'user_type_id' => 1
        ]);
        Users::firstOrCreate([
            'full_name' => 'Admin3',
            'email' => 'admin3@admin.com',
            'password' => bcrypt('admin'),
            'is_active' => 1,
            'password_reset_token' => str_random(60),
            'user_type_id' => 1
        ]);
        Users::firstOrCreate([
            'full_name' => 'Laravel User 1',
            'email' => 'user1@laravel.com',
            'password' => bcrypt('user123'),
            'is_active' => 1,
            'password_reset_token' => str_random(60),
            'user_type_id' => 2
        ]);
        Users::firstOrCreate([
            'full_name' => 'Laravel User 2',
            'email' => 'user2@laravel.com',
            'password' => bcrypt('user123'),
            'is_active' => 0,
            'password_reset_token' => str_random(60),
            'user_type_id' => 2
        ]);
        Users::firstOrCreate([
            'full_name' => 'Laravel User 3',
            'email' => 'user3@laravel.com',
            'password' => bcrypt('user123'),
            'is_active' => 1,
            'password_reset_token' => str_random(60),
            'user_type_id' => 2
        ]);
    }
}
