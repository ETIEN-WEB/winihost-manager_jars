<?php

namespace App\Http\Controllers\Auth\Autologin;

use App\Http\Controllers\Controller;
use App\myClass\Flasher;
use Illuminate\Encryption\Encrypter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class AutologinContoller extends Controller
{
    public function getShow(Request $request)
    {

        $Encrypt = new Encrypter(config('myconfig.ENCRYPT_KEY'), config('myconfig.ENCRYPT_CIPHER'));
        $token = $Encrypt->decrypt($request->token);
        $token = json_decode($token, true);

        $response = Http::withHeaders(
            [
                'X-Auth-Key' => $token['token'] ?? null,
                'X-Auth-Email' => $token['email'] ?? null,
            ]
        )->post(
            config('myconfig.API_URL_SCHEMA') . config('myconfig.API_BASE_URL') . '/user/profil/detail'
        )->json();

        if (isset($response['success']) &&  $response['success'] == false) {

            if ((int) substr($response['errors']['code'], 0, 1) == 2) {
                $errors[Str::afterLast($response['errors']['msg'], ' ')] = __('site.flasher.' . $response['errors']['code']);
            } else {
                Flasher::error(__('site.flasher.' . $response['errors']['code']));
            }
            return redirect()->route('Auth-LoginGetShow')->withErrors($errors ?? [], 'login')->withInput();
        } else {

            session([
                'UserSession.token.token_access' => $token['token'],
                'UserSession.token.token_email' => $token['email'],
                'UserSession.token.token_expired' => $token['expire'],
                'UserSession.profil' => $response['result'],

            ]);
        }

        return redirect()->route('Site-HomeGetShow');
    }
}
