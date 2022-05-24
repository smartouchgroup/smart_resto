<?php

namespace Database\Seeders;

use App\Models\Employee;
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
        $this->call([
            RoleSeeder::class,
            AdminSeeder::class,
            OrganizationSeeder::class,
            RestaurantSeeder::class,
            GroupSeeder::class,
            DaysSeeder::class,
        ]);
    }
}
