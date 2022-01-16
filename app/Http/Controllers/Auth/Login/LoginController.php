<?php

namespace App\Http\Controllers\Auth\Login;

use App\Http\Controllers\Controller;
use App\myClass\Flasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use hisorange\BrowserDetect\Parser as Browser;
use Illuminate\Encryption\Encrypter;
use Illuminate\Support\Facades\Cache;

class LoginController extends Controller
{

    public function getShow()
    {

        $data = [];

        if (Browser::isDesktop()) {

            $response = Cache::get('country_list', function () {

                $response = Http::post(config('myconfig.API_URL_SCHEMA') . config('myconfig.API_BASE_URL') . '/country/list')->json();

                $data = $response ? json_encode($response) : '[]';

                Cache::put('country_list', $data, now()->addDays(30));

                return $data;
            });

            $data['country'] = json_decode($response, true)['result'] ?? [];
        }
        return view('page.auth.login.show', $data);
    }

    public function postShow(Request $request)
    {

        $response = Http::post(
            config('myconfig.API_URL_SCHEMA') . config('myconfig.API_BASE_URL') . '/auth/login',
            [
                'email' => $request->email,
                'password' => $request->password,
                'ip' => $request->server('HTTP_CF_CONNECTING_IP') ??
                    $request->server('HTTP_X_FORWARDED_FOR') ??
                    $request->server('REMOTE_ADDR'),
                'user_agent' => $request->server('HTTP_USER_AGENT'),
            ]
        )->json();

        if (empty($response) || (isset($response['success']) &&  $response['success'] == false)) {

            if (empty($response)) {

                Flasher::error(__('site.flasher.0000'));
            } elseif ((int) substr($response['errors']['code'], 0, 1) == 2) {

                $error_msg = __('site.flasher.' . $response['errors']['code']);

                Flasher::error($error_msg);
                $errors[Str::afterLast($response['errors']['msg'], ' ')] = $error_msg;
            } else {

                Flasher::error(__('site.flasher.' . $response['errors']['code']));
            }

            return redirect()->back()->withErrors($errors ?? [], 'login')->withInput();
        }

        session(['UserSession.token' => $response['result'] ?? []]);

        if (!empty($request->from)) {

            // Verifier s'il sagit d'une autre platforme
            // Faire une redirection vers son lien autologin
            if (in_array($request->platform, ['site']) && $request->autologin) {

                $Encrypt = new Encrypter(config('myconfig.ENCRYPT_KEY'), config('myconfig.ENCRYPT_CIPHER'));
                $token = $Encrypt->encrypt(json_encode($response['result']));

                $params = http_build_query([
                    'from' => $request->from,
                    'token' => $token,
                ]);

                return redirect()->to($request->autologin . '?' . $params);
            }

            // Verifier si le lien de redirection est de winihost
            $check_link = stripos(parse_url(urldecode($request->from), PHP_URL_HOST), config('myconfig.APP_BASE_URL'));
            if ($check_link === false) {
                return redirect()->to(config('myconfig.API_URL_SCHEMA') . config('myconfig.MAN_BASE_URL'));
            }
            return redirect()->to($request->from);
        }

        return redirect()->route('Site-HomeGetShow');
    }
}
