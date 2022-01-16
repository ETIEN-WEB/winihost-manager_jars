<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;

class BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        /**
         * Configuration de la langue
         */
        $preference = json_decode(Cookie::get('preference'));
        if (empty($preference)) {
            $preference = ['language' => 'fr', 'currency' => 'xof'];
            Cookie::queue('preference', json_encode($preference), now()->diffInMinutes(now()->addMonths(12)));
        }
        optional($preference)->language == 'en' ? App::setLocale('en') : App::setLocale('fr');

        /**
         * Recuperation des App-Info
         */
        if (empty(session('UserSession.app_info'))) {

            $app_info = Cache::get('app_info_list', function () {

                $response = Http::post(config('myconfig.API_URL_SCHEMA') . config('myconfig.API_BASE_URL') . '/app-info/list')->json();

                $data = $response ? json_encode($response) : '[]';

                Cache::put('app_info_list', $data, now()->addDays(30));

                return $data;
            });

            session(['UserSession.app_info' => (json_decode($app_info, true)['result'] ?? [])]);
        }

        return $next($request);
    }
}
