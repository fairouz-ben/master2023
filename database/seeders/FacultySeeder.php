<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Faculty;
use Illuminate\Database\Seeder;

class FacultySeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $faculties = [
            ['id' => 1,'name_ar' => 'الحقوق','name_fr' => 'Droit','code' => 'droit','speciality_max_choice' => '1','show_result' => '0','is_active' => '1','created_at' => '2022-09-22 15:05:01','updated_at' => '2022-09-22 15:05:01'],
            ['id' => 2,'name_ar' => 'العلوم الإسلامية','name_fr' => 'sciences islamique','code' => 'si','speciality_max_choice' => '1','show_result' => '0','is_active' => '1','created_at' => '2022-09-22 15:06:25','updated_at' => '2022-09-22 15:06:25'],
            ['id' => 3,'name_ar' => 'الطب','name_fr' => 'Médecine','code' => 'med','speciality_max_choice' => '1','show_result' => '0','is_active' => '0','created_at' => '2022-09-22 15:07:18','updated_at' => '2022-09-26 14:34:05'],
            ['id' => 4,'name_ar' => 'الصيدلة','name_fr' => 'Pharmacie','code' => 'pharmacie','speciality_max_choice' => '1','show_result' => '0','is_active' => '0','created_at' => '2022-09-22 15:08:04','updated_at' => '2022-09-23 10:46:27'],
            ['id' => 5,'name_ar' => 'كلية العلوم','name_fr' => 'Faculté des sciences','code' => 'sciences','speciality_max_choice' => '1','show_result' => '0','is_active' => '1','created_at' => '2022-09-23 13:22:17','updated_at' => '2022-09-26 14:34:20']
          ];
          foreach ($faculties as $item) {
              Faculty::updateOrCreate(['id' => $item['id']], $item);
          }
    }
}
