<?php

use Illuminate\Database\Seeder;
use App\Models\UserType;

class UserTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UserType::firstOrCreate([
            'name' => 'Admin'
        ]);
        UserType::firstOrCreate([
            'name' => 'User'
        ]);
       
    }
}
