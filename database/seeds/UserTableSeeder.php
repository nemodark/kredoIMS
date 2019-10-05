<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = App\User::create([
            'email' => 'kredoitstaff@gmail.com',
            'password' => Hash::make('kredo@IT'),
            'role' => 'admin',
            'api_token' => Str::random(60)
        ]);

        $profile = App\Profile::create([
            'user_id' => $user->id,
            'firstname' => 'Kredo',
            'lastname' => 'IT',
            'contact' => '09451503306'
        ]);
    }
}
