<?php

namespace App\Http\Controllers\Site\Hosting;

use App\Http\Controllers\Controller;
use App\myClass\Flasher;
use App\myClass\Helpy;
use Browser;
use Illuminate\Support\Facades\Http;

class HostingController extends Controller
{

    public function getShow()
    {

        // breadcrumb navidation
        $data['menu_active'] = 'subscription';
        $data['breadcrumb'] = [
            'Dashboad' => route('Site-HomeGetShow'),
            __('site.label.hosting') => null,
        ];

        // Appelle des modules via API
        $response = Helpy::callApiModule(['hosting_list']);

        if (isset($response['success']) && $response['success'] == true) {

            $data = array_merge($data, $response['result']);

        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));
            return back();
        }

        return view('page.site.hosting.show', $data);
    }

    public function getDetail($uuid)
    {

        // breadcrumb navidation
        $data['menu_active'] = 'subscription';
        $data['breadcrumb'] = [
            'Dashboad' => route('Site-HomeGetShow'),
            __('site.label.hosting') => null,
        ];

        // Appelle des modules via API
        $response = Helpy::callApiModule(['hosting_detail:' . $uuid]);

        if (isset($response['success']) && $response['success'] == true) {

            $data = array_merge($data, $response['result']);

        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));
            return back();
        }

        return view('page.site.hosting.detail', $data);
    }

    public function getRenew($uuid)
    {

        if ($uuid) {

            $response = Http::withHeaders(Helpy::authToken())->post(
                Helpy::apiEndpoint() . '/user/hosting/renew/' . $uuid,
            )->json();

            if (isset($response['success']) && $response['success'] == true) {

                Flasher::success(__('site.flasher.success_hosting_renew'));

                return redirect()->route('Site-CartGetShow');
            } else {

                Flasher::error(__('site.flasher.' . $response['errors']['code']));
            }
        } else {

            Flasher::error(__('site.flasher.error_renew'));
        }

        return redirect()->back();
    }
}
