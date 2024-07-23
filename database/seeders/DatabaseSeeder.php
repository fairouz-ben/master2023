<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\AppConfig;
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
        $this->call(FacultySeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(SpecialitiesSqlFileSeeder::class);
        
        $this->call(RoleSeeder::class); 
        $this->call(AdminSeeder::class);
        
        $this->call(AppConfigSeeder::class); 
        
        $this->call(CitiesSeeder::class); 
    }
}
