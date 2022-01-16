<?php

namespace App\Http\Controllers\Site\Session;

use App\Http\Controllers\Controller;
use App\myClass\Flasher;
use App\myClass\Helpy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SessionController extends Controller
{

    public function postDelete(Request $request, $uuid)
    {

        $response = Http::withHeaders(Helpy::authToken())->post(
            Helpy::apiEndpoint() . '/user/session/delete/' . $uuid
        )->json();

        if (isset($response['success']) && $response['success'] == true) {

            Flasher::success(__('site.flasher.success_session_delete'));
        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));
        }

        return back();
    }
}
