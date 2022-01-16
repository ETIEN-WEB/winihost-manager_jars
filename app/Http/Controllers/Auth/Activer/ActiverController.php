<?php

namespace App\Http\Controllers\Auth\Activer;

use App\Http\Controllers\Controller;
use App\myClass\Flasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ActiverController extends Controller
{
    public function getShow()
    {
        return view('page.auth.activer.show');
    }

    public function postShow(Request $request)
    {
        $code = !empty($request->token_activation) ? $request->token_activation : '-';

        return redirect()->route('Auth-ActiverGetAction', ['code' => $code]);
    }

    public function getAction(Request $request, $code)
    {

        $response = Http::post(
            config('myconfig.API_URL_SCHEMA') . config('myconfig.API_BASE_URL') . '/auth/register/activate',
            [
                'token_activation' => $code,
                'ip' => $request->server('HTTP_CF_CONNECTING_IP') ??
                    $request->server('HTTP_CF_CONNECTING_IP') ??
                    $request->server('HTTP_X_FORWARDED_FOR') ??
                    $request->server('REMOTE_ADDR'),
                'user_agent' => $request->server('HTTP_USER_AGENT'),
            ]
        )->json();
        if (isset($response['success']) &&  $response['success'] == false) {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));

            return redirect()->route('Auth-ActiverGetShow')->withInput(['token_activation' => $code]);
        } else {

            Flasher::success(__('site.flasher.success_activer'));

            session(['UserSession.token' => $response['result']]);

            return redirect()->route('Site-HomeGetShow');
        }
    }
}
