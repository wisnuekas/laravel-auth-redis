<?php

use Illuminate\Database\Seeder;
use App\User;

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
            'name' => 'Super',
            'email' => 'super@laravel-redis.test',
            'password' => bcrypt('admin123'),
        ]);
    }
}
