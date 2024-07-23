<?php

namespace App\Http\Controllers;

use App\Models\Faculty;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Date;

class WelcomeController extends Controller
{
   
    public function index()
    {
        // Get the configuration service
        $configService = App::make('configuration');

        // Retrieve the open_date value
        $openDate = $configService->getConfigurationValue('open_date');
        $closeDate = $configService->getConfigurationValue('close_date');
        $etat=false;
        // Check if the open date is valid
        $currentDate = Date::now();
        if ($openDate && $closeDate &&
        $currentDate->between($openDate, $closeDate, true))
      {
            $etat=true;
            return view('welcome',compact('etat'));
        } else {
            return view('welcome',compact('etat'));
        }
    }
}
