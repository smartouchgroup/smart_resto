<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $restaurant = User::create([
            'uuid' => Str::uuid(),
            'roleId' => 4,
            'firstname' => 'LaPerle',
            'phone' => 67458215,
            'phone_verified_at' => now(),
            'email' => 'laperle@gmail.com',
            'email_verified_at' => now(),
            'profile' => 'avatar.png',
            'password' => Hash::make('laperle5502')
        ]);

        Restaurant::create([
            'userId' => $restaurant->id,
            'slogan' => "Les meilleurs plats c'est chez nous!",
            'description' => "Nous sommes une jeune entreprise de restauration basé à Ouagadougou avec plus de 20 plats que nous offrons à la clientèle!",
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
            'localization' => 'Ouagadougou, Avenue Charles De Gaulles',
            'availability' => true
        ]);
    }
}
