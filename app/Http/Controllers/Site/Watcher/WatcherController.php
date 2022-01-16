<?php

namespace App\Http\Controllers\Site\Watcher;

use App\Http\Controllers\Controller;
use App\myClass\Flasher;
use App\myClass\Helpy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WatcherController extends Controller
{

    public function getShow()
    {

        // breadcrumb navidation
        $data['menu_active'] = 'subscription';
        $data['breadcrumb'] = [
            'Dashboad' => route('Site-HomeGetShow'),
            __('site.label.watcher') => null,
        ];

        // Appelle des modules via API
        $response = Helpy::callApiModule(['watcher_list', 'service_detail:domain']);

        if (isset($response['success']) && $response['success'] == true) {

            $data = array_merge($data, $response['result']);
        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));
            return back();
        }

        return view('page.site.watcher.show', $data);
    }

    public function postCreate(Request $request)
    {

        $response = Http::withHeaders(Helpy::authToken())->post(
            Helpy::apiEndpoint() . '/user/watcher/create',
            ['domain' => $request->domain]
        )->json();

        if (isset($response['success']) && $response['success'] == true) {

            Flasher::success(__('site.flasher.success_add_domain'));
        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));
        }

        return redirect()->back()->withInput();
    }

    public function postDelete($uuid)
    {
        if (session('UserSession.domain.hosting') > now()) {
            Flasher::info(__('site.wording.record_operation'));
            return back()->withInput();
        }

        $response = Http::withHeaders(Helpy::authToken())->post(
            Helpy::apiEndpoint() . '/user/watcher/delete/' . $uuid,
        )->json();

        if (isset($response['success']) && $response['success'] == true) {

            Flasher::success(__('site.flasher.success_domain_delete'));
            return redirect()->back();
        } else {

            $msg = $response['errors']['code'] != '0000' ? __('site.flasher.' . $response['errors']['code']) : $response['errors']['msg'];

            Flasher::error($msg);

            return back()->withInput();
        }
    }


}
