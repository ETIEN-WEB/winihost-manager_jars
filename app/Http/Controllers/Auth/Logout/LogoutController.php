<?php

namespace App\Http\Controllers\Auth\Logout;

use App\Http\Controllers\Controller;
use App\myClass\Flasher;
use App\myClass\Helpy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LogoutController extends Controller
{
    public function getShow(Request $request)
    {

        $response = Http::withHeaders(Helpy::authToken())->post(
            config('myconfig.API_URL_SCHEMA') . config('myconfig.API_BASE_URL') . '/auth/logout',
        )->json();

        if (isset($response['success']) &&  $response['success'] == false) {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));
        } else {

            session(['UserSession' => null]);

            Flasher::success(__('site.flasher.success_logout'));
        }

        return redirect()->route('Auth-LoginGetShow');
    }
}
