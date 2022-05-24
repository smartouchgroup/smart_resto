<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\Group;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Group::create([
            'name' => 'Agence Dapoya',
            'localization' => 'Dapoya_nimnin',
            'organizationId'=>1,
            'isPrincipal' => true,
            'phone' => 57863509,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
