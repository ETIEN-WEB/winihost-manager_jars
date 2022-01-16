<?php

namespace App\Http\Controllers\Site\Notification;

use App\Http\Controllers\Controller;
use App\myClass\Flasher;
use App\myClass\Helpy;
use Illuminate\Support\Facades\Http;
use Browser;

class NotificationController extends Controller
{

    public function getShow()
    {

        // breadcrumb navidation
        $data['menu_active'] = 'notification';
        $data['breadcrumb'] = [
            'Dashboad' => route('Site-HomeGetShow'),
            __('site.label.notification') => null,
        ];

        // Appelle des modules via API
        $response = Helpy::callApiModule(['notification_list']);

        if (isset($response['success']) && $response['success'] == true) {

            $data = array_merge($data, $response['result']);
        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));
            return back();
        }

        return view('page.site.notification.show', $data);
    }


    public function getDetail($uuid)
    {

        // breadcrumb navidation
        $data['menu_active'] = 'notification';
        $data['breadcrumb'] = [
            'Dashboad' => route('Site-HomeGetShow'),
            __('site.label.notification') => null,
        ];

        // Appelle des modules via API
        $response = Helpy::callApiModule(['notification_detail:' . $uuid, 'notification_list']);

        if (isset($response['success']) && $response['success'] == true) {

            $data = array_merge($data, $response['result']);

            $notification_available = collect($response['result']['notification_list'])->where('view', '=', null)->count();
            session(['UserSession.profil.notification' => $notification_available]);
        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));
            return back();
        }

        return view('page.site.notification.detail', $data);
    }

    public function postDelete($uuid)
    {

        $response = Http::withHeaders(Helpy::authToken())->post(
            Helpy::apiEndpoint() . '/user/notification/delete/' . $uuid,
        )->json();

        if (isset($response['success']) && $response['success'] == true) {

            Flasher::success(__('site.flasher.success_notification_delete'));
        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));
        }

        return redirect()->route('Site-NotificationGetShow');
    }

    public function postEmpty()
    {

        $response = Http::withHeaders(Helpy::authToken())->post(
            Helpy::apiEndpoint() . '/user/notification/empty',
        )->json();

        if (isset($response['success']) && $response['success'] == true) {

            Flasher::success(__('site.flasher.success_notification_delete'));
        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));
        }

        return redirect()->route('Site-NotificationGetShow');
    }
}
