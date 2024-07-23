<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $departments = [
            ['id' => '1', 'name_ar' => 'الإعلام الألي', 'name_fr' => 'Informatique', 'code' => NULL, 'speciality_max_choice' => '1', 'is_active' => '1', 'treatment_stat' => NULL, 'show_result' => '0', 'faculty_id' => '5', 'created_at' => '2022-09-23 13:42:28', 'updated_at' => '2022-09-23 19:09:11'],
            ['id' => '2', 'name_ar' => 'الرياضيات', 'name_fr' => 'Mathématique', 'code' => NULL, 'speciality_max_choice' => '1', 'is_active' => '1', 'treatment_stat' => NULL, 'show_result' => '0', 'faculty_id' => '5', 'created_at' => '2022-09-23 19:01:41', 'updated_at' => '2022-09-23 19:08:57'],
            ['id' => '3', 'name_ar' => 'علوم المادة', 'name_fr' => 'Sciences de la matière', 'code' => NULL, 'speciality_max_choice' => '1', 'is_active' => '1', 'treatment_stat' => NULL, 'show_result' => '0', 'faculty_id' => '5', 'created_at' => '2022-09-23 19:10:50', 'updated_at' => '2022-09-23 22:31:40'],
            ['id' => '4', 'name_ar' => 'العقائد والأديان', 'name_fr' => 'Oussoul Eddine', 'code' => NULL, 'speciality_max_choice' => '3', 'is_active' => '1', 'treatment_stat' => NULL, 'show_result' => '0', 'faculty_id' => '2', 'created_at' => '2022-09-25 00:23:49', 'updated_at' => '2022-09-25 00:28:35'],
            ['id' => '5', 'name_ar' => 'الشريعة والقانون', 'name_fr' => 'CHARIA', 'code' => NULL, 'speciality_max_choice' => '3', 'is_active' => '1', 'treatment_stat' => NULL, 'show_result' => '0', 'faculty_id' => '2', 'created_at' => '2022-09-25 00:24:38', 'updated_at' => '2022-09-25 00:28:07'],
            ['id' => '6', 'name_ar' => 'اللغة والحضارة العربية الإسلامية', 'name_fr' => 'Langue Arabe et Civilisation Islamique', 'code' => NULL, 'speciality_max_choice' => '3', 'is_active' => '1', 'treatment_stat' => NULL, 'show_result' => '0', 'faculty_id' => '2', 'created_at' => '2022-09-25 00:25:15', 'updated_at' => '2022-09-25 00:26:47'],
            ['id' => '7', 'name_ar' => 'الحقوق', 'name_fr' => 'Droit', 'code' => NULL, 'speciality_max_choice' => '2', 'is_active' => '1', 'treatment_stat' => NULL, 'show_result' => '0', 'faculty_id' => '1', 'created_at' => '2022-09-26 14:02:04', 'updated_at' => '2022-09-26 14:15:22'],
            ['id' => '8', 'name_ar' => 'الطب', 'name_fr' => 'Médecine', 'code' => NULL, 'speciality_max_choice' => '1', 'is_active' => '0', 'treatment_stat' => NULL, 'show_result' => '0', 'faculty_id' => '3', 'created_at' => '2022-09-26 14:02:47', 'updated_at' => '2022-09-26 14:35:37'],
            ['id' => '9', 'name_ar' => 'طب الأسنان', 'name_fr' => 'Dentaire', 'code' => NULL, 'speciality_max_choice' => '1', 'is_active' => '0', 'treatment_stat' => NULL, 'show_result' => '0', 'faculty_id' => '3', 'created_at' => '2022-09-26 14:03:57', 'updated_at' => '2022-09-26 14:35:33'],
            ['id' => '10', 'name_ar' =>  'علوم الطبيعية والحياة', 'name_fr' => 'Sciences naturelles et de la vie', 'code' => NULL, 'speciality_max_choice' => '3', 'is_active' => '1', 'treatment_stat' => NULL, 'show_result' => '0', 'faculty_id' => '5'],
            ['id' => '11', 'name_ar' => 'هندسة معمارية ', 'name_fr' => 'Architecture', 'code' => NULL, 'speciality_max_choice' => '3', 'is_active' => '1', 'treatment_stat' => NULL, 'show_result' => '0', 'faculty_id' => '5']

        ];
        foreach ($departments as $item) {
            Department::updateOrCreate(['id' => $item['id']], $item);
        }
    }
}
