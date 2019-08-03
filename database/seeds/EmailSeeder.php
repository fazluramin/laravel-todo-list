<?php

use Illuminate\Database\Seeder;
use App\Models\EmailSettings;

class EmailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EmailSettings::firstOrCreate([
            'api_key' => 'fdMHk8z3VIdZFS0WOdpi1Q',
            'sender_name' => 'Quark Spark',
            'sender_email' => 'us@quarkspark.com'
        ]);
    }
}
