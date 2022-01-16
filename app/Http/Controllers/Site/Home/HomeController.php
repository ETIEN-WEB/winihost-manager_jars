<?php

namespace App\Http\Controllers\Site\Home;

use App\Http\Controllers\Controller;
use App\myClass\Flasher;
use App\myClass\Helpy;
use Carbon\Carbon;

class HomeController extends Controller
{

    public function getShow()
    {

        // breadcrumb navidation
        $data['menu_active'] = 'home';
        $data['breadcrumb'] = [
            'Dashboad' => route('Site-HomeGetShow'),
            'Compte' => null,
        ];

        // Appelle des modules via API
        $response = Helpy::callApiModule(
            [
                'ticket_list', 'order_list', 'session_list',
                'domain_list', 'hosting_list', 'point_detail',
                'monitoring_list', 'watcher_list'
            ]
        );

        if (isset($response['success']) && $response['success'] == true) {

            $data = array_merge($data, $response['result']);

            // Decompte des domains qui expire dans 30j
            $data['domain_expired'] = 0;
            foreach ($data['domain_list'] as $domain) {
                $expired = Carbon::parse($domain['expired'])->subDays(30);
                if ($expired < now()) {
                    $data['domain_expired'] = $data['domain_expired'] + 1;
                }
            }

            // Decompte des domains qui expire dans 30j
            $data['hosting_expired'] = 0;
            foreach ($data['hosting_list'] as $hosting) {
                if ($hosting['expired'] !== null) {
                    $expired = Carbon::parse($hosting['expired'])->subDays(30);
                    if ($expired < now()) {
                        $data['hosting_expired'] = $data['hosting_expired'] + 1;
                    }
                }
            }
        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));
            return back();
        }

        return view('page.site.home.show', $data);
    }
}
