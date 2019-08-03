<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(EmailSeeder::class);
        $this->call(UserTypeSeeder::class);
        $this->call(UserSeeder::class); 
        
    }
}
