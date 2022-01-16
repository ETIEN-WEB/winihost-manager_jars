<?php

namespace App\Http\Controllers\site\Monitoring;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\myClass\Flasher;
use App\myClass\Helpy;
use Browser;
use Illuminate\Support\Facades\Http;

class MonitoringController extends Controller
{

    public function getShow()
    {

        // breadcrumb navidation
        $data['menu_active'] = 'subscription';
        $data['breadcrumb'] = [
            'Dashboad' => route('Site-HomeGetShow'),
            __('site.label.monitoring') => null,
        ];

        // Appelle des modules via API
        $response = Helpy::callApiModule(['monitoring_list']);

        if (isset($response['success']) && $response['success'] == true) {

            $data = array_merge($data, $response['result']);
        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));
            return back();
        }

        return view('page.site.monitoring.show', $data);
    }

    public function getDetail($uuid)
    {

        // breadcrumb navidation
        $data['menu_active'] = 'monitoring';
        $data['breadcrumb'] = [
            'Dashboad' => route('Site-HomeGetShow'),
            __('site.label.monitoring') => null,
        ];

        // Appelle des modules via API
        $response = Helpy::callApiModule(['monitoring_detail:' . $uuid, 'monitoring_list']);

        if (isset($response['success']) && $response['success'] == true) {

            $data = array_merge($data, $response['result']);

            $statistics = $data['monitoring_detail']['statistics'];

            $data['statistics'] = collect($statistics);

            if (!Browser::isMobile()) {
                $statistics = $data['statistics']->chunk(60)->last()->toArray();

                $data['statistic_keys'] = json_encode(array_keys($statistics));
                $data['statistic_values'] = json_encode(array_values($statistics));
            }
        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));
            return back();
        }

        return view('page.site.monitoring.detail', $data);
    }

    public function getCreate()
    {
        // breadcrumb navidation
        $data['menu_active'] = 'subscription';
        $data['breadcrumb'] = [
            'Dashboad' => route('Site-HomeGetShow'),
            __('site.label.monitoring') => null,
        ];

        // Appelle des modules via API
        $response = Helpy::callApiModule(['monitoring_list', 'hosting_list']);

        if (isset($response['success']) && $response['success'] == true) {

            $data = array_merge($data, $response['result']);
        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));
            return back();
        }

        return view('page.site.monitoring.create', $data);
    }

    public function postCreate(Request $request)
    {

        $response = Http::withHeaders(Helpy::authToken())->post(
            Helpy::apiEndpoint() . '/user/monitoring/create',
            [
                'url' => $request->url,
                'method' => $request->method,
            ]
        )->json();

        if (isset($response['success']) && $response['success'] == true) {

            Flasher::success(__('site.flasher.success_domain_create'));

            return redirect()->route('Site-MonitoringGetDetail', ['uuid' => $response['result']['uuid']]);
        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));

            return back()->withInput();
        }
    }

    public function postDelete($uuid)
    {

        $response = Http::withHeaders(Helpy::authToken())->post(
            Helpy::apiEndpoint() . '/user/monitoring/delete/' . $uuid,
        )->json();

        if (isset($response['success']) && $response['success'] == true) {

            Flasher::success(__('site.flasher.success_monitoring_delete'));
        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));
        }

        return redirect()->route('Site-MonitoringGetShow');
    }

    public function getEdite($uuid)
    {
        // breadcrumb navidation
        $data['menu_active'] = 'subscription';
        $data['breadcrumb'] = [
            'Dashboad' => route('Site-HomeGetShow'),
            __('site.label.monitoring') => null,
        ];

        // Appelle des modules via API
        $response = Helpy::callApiModule(['monitoring_detail:' . $uuid, 'monitoring_list']);

        if (isset($response['success']) && $response['success'] == true) {

            $data = array_merge($data, $response['result']);

            if (empty($data['monitoring_detail'])) {
                Flasher::error(__('site.flasher.error_monitoring_not_avaible'));
                return back();
            }
        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));
            return back();
        }

        return view('page.site.monitoring.edite', $data);
    }

    public function postEdite(Request $request, $uuid)
    {

        $response = Http::withHeaders(Helpy::authToken())->post(
            Helpy::apiEndpoint() . '/user/monitoring/edite/' . $uuid,
            [
                'method' => $request->method,
                'status' => $request->status,
            ]
        )->json();

        if (isset($response['success']) && $response['success'] == true) {

            Flasher::success(__('site.flasher.success_monitoring_edite'));

            return redirect()->route('Site-MonitoringGetDetail', ['uuid' => $uuid]);
        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));

            return back()->withInput();
        }
    }
}
