<?php

namespace App\Http\Controllers\Site\Service;

use App\Http\Controllers\Controller;
use App\myClass\Flasher;
use App\myClass\Helpy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Browser;
use Illuminate\Support\Str;

class ServiceController extends Controller
{

    public function getShow()
    {

        $data['menu_active'] = 'service';
        $data['breadcrumb'] = [
            'Dashboad' => route('Site-HomeGetShow'),
            __('site.label.service') => null,
        ];

        // Appelle des modules via API
        $response = Helpy::callApiModule(['service_list']);

        if (isset($response['success']) && $response['success'] == true) {

            $data = array_merge($data, $response['result']);

            $data['service_list'] = collect($data['service_list'])
                ->whereIn('slug', ['web-perso', 'domain', 'point', 'vps-perso', 'scanfolder', 'com-digitale'])
                ->toArray();
        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));
            return back();
        }

        return view('page.site.service.show', $data);
    }

    public function getDetail($service)
    {

        $data['menu_active'] = 'service';
        $data['breadcrumb'] = [
            'Dashboad' => route('Site-HomeGetShow'),
            __('site.label.service') => null,
        ];

        // Appelle des modules via API
        $response = Helpy::callApiModule(['service_detail:' . $service]);

        if (isset($response['success']) && $response['success'] == true) {

            $data = array_merge($data, $response['result']);
        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));
            return back();
        }

        return view('page.site.service.detail', $data);
    }

    public function getSubscribe(Request $request, $service, $package)
    {

        $response = Http::withHeaders(Helpy::authToken())->post(
            Helpy::apiEndpoint() . '/user/cart/create',
            [
                'service' => $service,
                'package' => $package,
                'action' => 'purchase',
                'detail' => $request->detail,
                'quantity' => 1,
            ]
        )->json();

        if (isset($response['success']) && $response['success'] == false) {

            Flasher::error(__('site.falsher.errors'));

            $name = Str::afterLast($response['errors']['msg'], ' ');

            return redirect()->back()->withInput()->withErrors([$name => __('site.flasher.' . $response['errors']['code'])]);
        }

        Flasher::success(__('site.flasher.success_cart_create'));
        return redirect()->route('Site-ServiceGetSuite', ['service' => $service]);
    }

    public function getSuite($service)
    {

        $data['menu_active'] = 'service';
        $data['breadcrumb'] = [
            'Dashboad' => route('Site-HomeGetShow'),
            __('site.label.service') => null,
        ];

        // Appelle des modules via API
        $response = Helpy::callApiModule(['service_list', 'service_detail:' . $service]);

        if (isset($response['success']) && $response['success'] == true) {

            $data = array_merge($data, $response['result']);
        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));
            return back();
        }

        return view('page.site.service.suite', $data);
    }
}
