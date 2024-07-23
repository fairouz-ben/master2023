<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Date;
use Symfony\Component\HttpFoundation\Response;

class CheckOpenDate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        // Assuming you have a service or helper to get the configuration value
        // $configService = app('App\Services\ConfigService'); // Replace with your service or helper
        $configService = App::make('configuration');

        // Retrieve the open_date value
        $openDate = $configService->getConfigurationValue('open_date');
        $closeDate = $configService->getConfigurationValue('close_date');
        $currentDate = Date::now();
        if ($openDate && $closeDate &&
        $currentDate->between($openDate, $closeDate, true))
        {
            return $next($request);
        }

        // Redirect or return a response indicating the registration is closed
        return redirect()->route('/'); // Replace with your desired route

    }
}
