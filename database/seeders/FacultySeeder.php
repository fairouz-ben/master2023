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
            ['id' => 1,'name_ar' => 'الحقوق','name_fr' => 'Droit','code' => 'droit','speciality_max_choice' => '1','show_result' => '0','is_active' => '1',],
            ['id' => 2,'name_ar' => 'العلوم الإسلامية','name_fr' => 'sciences islamique','code' => 'si','speciality_max_choice' => '1','show_result' => '0','is_active' => '1',],
            ['id' => 3,'name_ar' => 'الطب','name_fr' => 'Médecine','code' => 'med','speciality_max_choice' => '1','show_result' => '0','is_active' => '0'],
            ['id' => 4,'name_ar' => 'الصيدلة','name_fr' => 'Pharmacie','code' => 'pharmacie','speciality_max_choice' => '1','show_result' => '0','is_active' => '0'],
            ['id' => 5,'name_ar' => 'كلية العلوم','name_fr' => 'Faculté des sciences','code' => 'sciences','speciality_max_choice' => '1','show_result' => '0','is_active' => '1']
          ];
          foreach ($faculties as $item) {
              Faculty::updateOrCreate(['id' => $item['id']], $item);
          }
    }
}
