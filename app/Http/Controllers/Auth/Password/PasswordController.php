<?php

namespace App\Http\Controllers\Auth\Password;

use App\Http\Controllers\Controller;
use App\myClass\Flasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PasswordController extends Controller
{
    public function getShow()
    {
        return view('page.auth.password.show');
    }

    public function postShow(Request $request)
    {

        $data_form = $request->except(['_token']);
        $data_form['url_back'] = Str::limit(route('Auth-PasswordGetReset', ['uuid' => '-']), -1, '');

        $response = Http::post(config('myconfig.API_URL_SCHEMA') . config('myconfig.API_BASE_URL') . '/auth/password', $data_form)->json();

        if (empty($response) || (isset($response['success']) && $response['success'] == false)) {

            $code = empty($response) ? '0000' : $response['errors']['code'];

            Flasher::error(__('site.flasher.' . $code));

            return redirect()->back()->withInput();
        } else {

            Flasher::success(__('site.flasher.success_send_password'));

            return redirect()->route('Auth-LoginGetShow');
        }
    }

    public function getReset(Request $request, $uuid)
    {

        return view('page.auth.password.reset');
    }

    public function postReset(Request $request, $uuid)
    {

        $response = Http::post(config('myconfig.API_URL_SCHEMA') . config('myconfig.API_BASE_URL') . '/auth/password/reset', [
            'email' => $request->email,
            'token_password' => $uuid,
            'password' => $request->password,
        ])->json();

        if (isset($response['success']) &&  $response['success'] == false) {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));
            return redirect()->back()->withInput();
        } else {

            Flasher::success(__('site.flasher.success_reset_password'));

            return redirect()->route('Auth-LoginGetShow');
        }
    }
}
