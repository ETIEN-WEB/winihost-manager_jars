<?php

namespace App\Http\Controllers\Site\Order;

use App\Http\Controllers\Controller;
use App\myClass\Flasher;
use App\myClass\Helpy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Browser;

class OrderController extends Controller
{

    public function getShow()
    {

        $data['menu_active'] = 'order';
        $data['breadcrumb'] = [
            'Dashboad' => route('Site-HomeGetShow'),
            __('site.label.order') => null,
        ];

        // Appelle des modules via API
        $response = Helpy::callApiModule(['order_list']);

        if (isset($response['success']) && $response['success'] == true) {

            $data = array_merge($data, $response['result']);

        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));
            return back();
        }

        return view('page.site.order.show', $data);
    }

    public function getDetail($uuid)
    {

        $data['menu_active'] = 'order';
        $data['breadcrumb'] = [
            'Dashboad' => route('Site-HomeGetShow'),
            __('site.label.order') => null,
        ];

        // Appelle des modules via API
        $response = Helpy::callApiModule(['order_detail:' . $uuid]);

        if (isset($response['success']) && $response['success'] == true) {

            $data = array_merge($data, $response['result']);

        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));
            return back();
        }

        return view('page.site.order.detail', $data);
    }

    public function postGenerate(Request $request)
    {

        $response = Http::withHeaders(Helpy::authToken())->post(
            Helpy::apiEndpoint() . '/user/order/generate',
            [
                'promo_code' => $request->promo_code,
            ]
        )->json();

        if (isset($response['success']) && $response['success'] == true) {

            session(['UserSession.code_promo' => null]);

            Flasher::success(__('site.flasher.success_order_create'));

            return redirect()->route('Site-OrderGetDetail', ['uuid' => $response['result']['uuid']]);
        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));

            return back();
        }
    }
}
