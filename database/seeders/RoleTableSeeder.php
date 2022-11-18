<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdminRole = Role::create(['name' => 'Super Admin']);
        $financeRole = Role::create(['name' => 'Treasurer']);
        $financeRole = Role::create(['name' => 'General Secretary']);
        $financeRole = Role::create(['name' => 'President']);

    }
}
