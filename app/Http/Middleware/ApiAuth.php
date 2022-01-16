<?php

namespace App\Http\Middleware;

use App\myClass\Helpy;
use Closure;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class ApiAuth
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

        if (empty(session('UserSession.token'))) {

            return redirect()->route('Auth-LoginGetShow', ['from' => url()->full()]);
        } else {

            /**
             * Recuperation des données du User
             */
            $profil = Http::withHeaders(Helpy::authToken())
                ->post(
                    config('myconfig.API_URL_SCHEMA') . config('myconfig.API_BASE_URL') . '/user/profil/detail',
                )->json();

            if ($profil['success'] == true) {

                session(['UserSession.profil' => $profil['result']]);
            } else {

                session(['UserSession' => null]);
                return redirect()->route('Auth-LoginGetShow', ['from' => url()->full()]);
            }
        }

        return $next($request);
    }
}
