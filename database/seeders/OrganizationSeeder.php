<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Organization;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class OrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $organization = User::create([
            'uuid' => Str::uuid(),
            'roleId' => 3,
            'firstname' => 'Boa',
            'phone' => 70556677,
            'email' => 'boadapoya@gmail.com',
            'email_verified_at' => now(),
            'profile' => 'picture.png',
            'password' => Hash::make('test'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Organization::create([
            'userId' => $organization->id,
            'slogan' => "Jeune entreprise motivé!",
            'description' => "Nous sommes une jeune entreprise situé à ouagadougou!",
            'schedules' => json_encode([
                "Lundi" => [
                    "open" => "8h00",
                    "close" => "22h00"
                ],
                "Mardi" => [
                    "open" => "8h00",
                    "close" => "22h00"
                ],
                "Mercredi" => [
                    "open" => "8h00",
                    "close" => "22h00"
                ],
                "Jeudi" => [
                    "open" => "8h00",
                    "close" => "22h00"
                ],
                "Vendredi" => [
                    "open" => "8h00",
                    "close" => "22h00"
                ],
                "Samedi" => [
                    "open" => "8h00",
                    "close" => "22h00"
                ],
            ]),
            'ticketNumber' => '20',
            'ticketPrice' => '25000',
            'allowedDishPerDay'=> '2',
        ]);
    }
}
