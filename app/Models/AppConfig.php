<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AppConfig extends Model
{
    use HasFactory;
    protected $fillable = [
      
    'key',
    'value',
    'data_type'
    ];

  /*  public function getConfigurationValue($key)
{
    $value = Cache::get('configuration_' . $key);

    if (!$value) {
        $configuration = AppConfig::where('key', $key)->first();
        $value = $configuration ? $configuration->value : null; // Handle missing configuration

        // Cache the value for subsequent requests
        Cache::put('configuration_' . $key, $value, now()->addDay(1)); //  addMinutes(60)); // Adjust cache expiration as needed
    }

    return $value;
}*/
}
