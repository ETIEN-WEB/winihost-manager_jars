<?php

namespace App\Http\Controllers\Site\Profile;

use App\Http\Controllers\Controller;
use App\myClass\Flasher;
use App\myClass\Helpy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProfileController extends Controller
{

    public function postUpdate(Request $request)
    {

        $data = [
            'first_name' => $request->first_name ?? session('UserSession.profil.first_name'),
            'last_name' => $request->last_name ?? session('UserSession.profil.last_name'),
            'city' => $request->city ?? session('UserSession.profil.city'),
            'phone' => $request->phone ?? session('UserSession.profil.phone'),
            'gender' =>  $request->gender ?? session('UserSession.profil.gender'),
            'birth_date' =>  $request->birth_date ?? session('UserSession.profil.birth_date'),
        ];

        if ($request->hasFile('photo')) {
            $data['photo'] =  'data:image/' . $request->photo->getClientOriginalExtension() . ';base64,' . base64_encode($request->photo->get());
        }

        $response = Http::withHeaders(Helpy::authToken())->post(
            Helpy::apiEndpoint() . '/user/profil/update',
            $data
        )->json();

        if (isset($response['success']) && $response['success'] == true) {

            Flasher::success(__('site.flasher.success_profil_update'));
        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));
        }

        return back();
    }

    public function postPassword(Request $request)
    {

        if (empty($request->old_password) || strlen($request->old_password) < 6) {

            Flasher::error(__('site.flasher.2006'));
        } elseif (empty($request->password) || strlen($request->password) < 6) {

            Flasher::error(__('site.flasher.2005'));
        } else {

            $response = Http::withHeaders(Helpy::authToken())->post(
                Helpy::apiEndpoint() . '/user/profil/password',
                [
                    'old_password' => $request->old_password,
                    'password' => $request->password,
                ]
            )->json();

            if (isset($response['success']) && $response['success'] == true) {

                Flasher::success(__('site.flasher.success_password_update'));
            } else {

                Flasher::error(__('site.flasher.' . $response['errors']['code']));
            }
        }

        return back();
    }
}
