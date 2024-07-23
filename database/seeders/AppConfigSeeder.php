<?php

namespace Database\Seeders;

use App\Models\AppConfig;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AppConfigSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $conf = [
            ['id' => 1,'key' => 'open_date','value' =>'' ,'data_type'=>'date'],
            ['id' => 2,'key' => 'close_date','value' => '', 'data_type'=>'date'],
            ['id' => 3,'key' => 'default_lang','value' => 'fr','data_type'=>'text'],
          ];
          foreach ($conf as $item) {
              AppConfig::updateOrCreate(['id' => $item['id']], $item);
          }
    }
}
