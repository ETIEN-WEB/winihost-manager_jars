<?php

namespace App\Http\Controllers\Site\Subscription;

use App\Http\Controllers\Controller;
use App\myClass\Flasher;
use App\myClass\Helpy;
use Browser;

class SubscriptionController extends Controller
{

    public function getShow()
    {

        // breadcrumb navidation
        $data['menu_active'] = 'subscription';
        $data['breadcrumb'] = [
            'Dashboad' => route('Site-HomeGetShow'),
            __('site.label.subscription') => null,
        ];

        // Appelle des modules via API
        $response = Helpy::callApiModule(['domain_list', 'hosting_list', 'watcher_list', 'monitoring_list', 'scanfolder_list']);

        if (isset($response['success']) && $response['success'] == true) {

            $data = array_merge($data, $response['result']);
        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));
            return back();
        }

        return view('page.site.subscription.show', $data);
    }
}
