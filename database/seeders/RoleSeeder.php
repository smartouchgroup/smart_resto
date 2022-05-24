<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = ['Super Administrateur','Moderateur','Structure','Prestataire','Personnel'];
        foreach ($roles as $role) {
            DB::table('roles')->insert([
                'label' => $role,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
