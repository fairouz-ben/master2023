<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['id' => 1, 'name' => 'administrator','code' => 'supdmin','description'=>'supper admin'],
            ['id' => 2, 'name' => 'manager','code' => 'mg','description'=>'supper manager'],
            ['id' => 3, 'name' => 'supervisor','code' => 'spv','description'=>'supervisor'],
            
        ];

        foreach ($roles as $item) {
            Role::updateOrCreate(['id' => $item['id']], $item);
        }
    }
}
