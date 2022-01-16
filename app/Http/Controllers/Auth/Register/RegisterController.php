<?php

namespace App\Http\Controllers\Auth\Register;

use App\Http\Controllers\Controller;
use App\myClass\Flasher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function getShow()
    {
        $response = Cache::get('country_list', function () {

            $response = Http::post(config('myconfig.API_URL_SCHEMA') . config('myconfig.API_BASE_URL') . '/country/list')->json();
            $data = $response ? json_encode($response) : '[]';

            Cache::put('country_list', $data, now()->addDays(30));

            return $data;
        });

        $data['country'] = json_decode($response, true)['result'] ?? [];

        return view('page.auth.register.show', $data);
    }

    public function postShow(Request $request)
    {

        $data_form = $request->except(['_token']);
        $data_form['url_back'] = Str::limit(route('Auth-ActiverGetAction', ['code' => '-']), -1, '');

        $response = Http::post(config('myconfig.API_URL_SCHEMA') . config('myconfig.API_BASE_URL') . '/auth/register', $data_form)->json();

        if (empty($response) || (isset($response['success']) &&  $response['success'] == false)) {

            if (empty($response)) {

                Flasher::error(__('site.flasher.0000'));
            } elseif ((int) substr($response['errors']['code'], 0, 1) == 2) {

                $errors[Str::afterLast($response['errors']['msg'], ' ')] = __('site.flasher.' . $response['errors']['msg']);
            } elseif ((int) $response['errors']['code'] == 1003) {

                $errors['email'] = __('site.flasher.' . $response['errors']['code']);
            } else {

                Flasher::error(__('site.flasher.' . $response['errors']['code']));
            }

            return redirect()->back()->withErrors($errors ?? [], 'register')->withInput();
        } else {

            Flasher::success(__('site.flasher.success_register') . $request->email);

            return redirect()->route('Auth-ActiverGetShow');
        }
    }
}
