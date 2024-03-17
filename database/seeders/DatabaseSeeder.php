<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::where("email",'admin@gmail.com')->first();
        if (empty($user)) {
            User::create([
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'phone_number' => '01682234164',
                'password' => '123456'
            ]);
        }
    }
}
