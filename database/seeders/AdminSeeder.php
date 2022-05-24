<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'uuid' => Str::uuid(),
            'roleId' => 1,
            'firstname' => 'SmartRestoAdmin',
            'phone' => 55026262,
            'phone_verified_at' => now(),
            'email' => 'smt@gmail.com',
            'email_verified_at' => now(),
            'profile' => 'avatar.png',
            'password' => Hash::make('SMT@5502!')
        ]);
    }
}
