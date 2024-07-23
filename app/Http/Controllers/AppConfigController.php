<?php

namespace App\Http\Controllers;

use App\Models\AppConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AppConfigController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $configs = AppConfig::all(); //where('id','=','1')->get();
        return view('admin.appconfig.index', compact('configs'));
    }
    public function update(Request $request, AppConfig $appConfig)
    {
        $appConfig->update([
            'value' =>  $request->value,
        ]);
        // Configuration::where('key', $appConfig->key)->update(['value' => $request->value]);
        //Cache::tags('configuration')->flush();
        //Cache::clear();
        Cache::forget('configuration_' . $appConfig->key);
        $value = Cache::get('configuration_' . $appConfig->key);

        return back();
    }
}
