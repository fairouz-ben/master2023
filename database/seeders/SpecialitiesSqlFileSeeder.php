<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SpecialitiesSqlFileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = database_path('seeders/specialities.sql');
        
        // Read the SQL file
        $sql = File::get($path);
        
        // Execute the SQL file
        DB::unprepared($sql);
    }
}
