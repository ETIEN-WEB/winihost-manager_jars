<?php

namespace App\Http\Controllers\Site\Cart;

use App\Http\Controllers\Controller;
use App\myClass\Flasher;
use App\myClass\Helpy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Browser;
use Carbon\Carbon;

class CartController extends Controller
{

    public function getShow()
    {

        $data['menu_active'] = '';
        $data['breadcrumb'] = [
            'Dashboad' => route('Site-HomeGetShow'),
            __('site.label.cart') => null,
        ];

        // Appelle des modules via API
        $response = Helpy::callApiModule(['cart_list']);

        if (isset($response['success']) && $response['success'] == true) {

            $data = array_merge($data, $response['result']);
        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));
            return back();
        }

        return view('page.site.cart.show', $data);
    }

    public function getRenewAll(Request $request)
    {

        // Appelle des modules via API
        $response = Helpy::callApiModule(
            ['domain_list', 'hosting_list',]
        );

        $services = explode(',', $request->services);
        foreach ($services as $service) {
            switch ($service) {
                case 'domain':
                    foreach ($response['result']['domain_list'] as $domain) {
                        $expired = Carbon::parse($domain['expired'])->subDays(30);
                        if ($expired < now() && $domain['registrar_self'] == true) {
                            Http::withHeaders(Helpy::authToken())->post(
                                Helpy::apiEndpoint() . '/user/domain/renew/' . $domain['uuid']
                            )->json();
                        }
                    }
                    break;
                case 'hosting':
                    foreach ($response['result']['hosting_list'] as $hosting) {
                        $expired = Carbon::parse($hosting['expired'])->subDays(30);
                        if ($hosting['expired'] !== null && $expired < now()) {
                            Http::withHeaders(Helpy::authToken())->post(
                                Helpy::apiEndpoint() . '/user/hosting/renew/' . $hosting['uuid'],
                            )->json();
                        }
                    }
                    break;
                default:
                    # code...
                    break;
            }
        }

        return redirect()->route('Site-CartGetShow');
    }

    public function postUpdate(Request $request, $uuid)
    {

        $response = Http::withHeaders(Helpy::authToken())->post(
            Helpy::apiEndpoint() . '/user/cart/update/' . $uuid,
            [
                'quantity' => $request->quantity
            ]
        )->json();

        if (isset($response['success']) && $response['success'] == true) {

            Flasher::success(__('site.flasher.success_cart_update'));
        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));
        }

        return redirect()->route('Site-CartGetShow');
    }

    public function getDelete($uuid)
    {

        $response = Http::withHeaders(Helpy::authToken())->post(
            Helpy::apiEndpoint() . '/user/cart/delete/' . $uuid,
        )->json();

        if (isset($response['success']) && $response['success'] == true) {

            Flasher::success(__('site.flasher.success_cart_delete'));
        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));
        }

        return redirect()->route('Site-CartGetShow');
    }

    public function checkCode(Request $request)
    {

        session(['UserSession.code_promo' => null]);

        if ($request->code) {

            $response = Http::withHeaders(Helpy::authToken())->post(
                Helpy::apiEndpoint() . '/user/promo-code/detail/' . $request->code,
            )->json();

            if (isset($response['success']) && $response['success'] == true) {

                session(['UserSession.code_promo' => $response['result']]);

                Flasher::success(__('site.flasher.success_code_promo_check'));
            } else {

                Flasher::error(__('site.flasher.' . $response['errors']['code']));
            }
        } else {

            Flasher::error(__('site.wording.please_enter_promo_code'));
        }

        return redirect()->route('Site-CartGetShow', ['code' => $request->code]);
    }
}
