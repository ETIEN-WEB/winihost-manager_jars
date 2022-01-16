<?php

namespace App\Http\Controllers\Site\Domain;

use App\Http\Controllers\Controller;
use App\myClass\Flasher;
use App\myClass\Helpy;
use Illuminate\Http\Request;
use Browser;
use Illuminate\Support\Facades\Http;

class DomainController extends Controller
{

    public function getShow()
    {

        // breadcrumb navidation
        $data['menu_active'] = 'subscription';
        $data['breadcrumb'] = [
            'Dashboad' => route('Site-HomeGetShow'),
            __('site.label.domain') => null,
        ];

        // Appelle des modules via API
        $response = Helpy::callApiModule(['domain_list']);

        if (isset($response['success']) && $response['success'] == true) {

            $data = array_merge($data, $response['result']);
        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));
            return back();
        }

        return view('page.site.domain.show', $data);
    }

    public function getDetail($uuid)
    {

        // breadcrumb navidation
        $data['menu_active'] = 'subscription';
        $data['breadcrumb'] = [
            'Dashboad' => route('Site-HomeGetShow'),
            __('site.label.domain') => null,
        ];

        // Appelle des modules via API
        $response = Helpy::callApiModule(['hosting_list', 'domain_detail:' . $uuid, 'domain_record:' . $uuid]);

        if (isset($response['success']) && $response['success'] == true) {

            $data = array_merge($data, $response['result']);
        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));
            return back();
        }

        return view('page.site.domain.detail', $data);
    }

    public function getCreate()
    {
        // breadcrumb navidation
        $data['menu_active'] = 'subscription';
        $data['breadcrumb'] = [
            'Dashboad' => route('Site-HomeGetShow'),
            __('site.label.domain') => null,
        ];

        // Appelle des modules via API
        $response = Helpy::callApiModule(['domain_list', 'hosting_list']);

        if (isset($response['success']) && $response['success'] == true) {

            $data = array_merge($data, $response['result']);
        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));
            return back();
        }

        return view('page.site.domain.create', $data);
    }

    public function postCreate(Request $request)
    {

        $response = Http::withHeaders(Helpy::authToken())->post(
            Helpy::apiEndpoint() . '/user/domain/create',
            $request->all()
        )->json();

        if (isset($response['success']) && $response['success'] == true) {

            Flasher::success(__('site.flasher.success_domain_create'));

            return redirect()->route('Site-DomainGetShow');
        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));

            return back()->withInput();
        }
    }

    public function postHosting(Request $request, $uuid)
    {


        if (session('UserSession.domain.hosting') > now()) {

            Flasher::info(__('site.wording.record_operation'));
            return back()->withInput();
        }

        $response = Http::withHeaders(Helpy::authToken())->post(
            Helpy::apiEndpoint() . '/user/domain/hosting/' . $uuid,
            $request->all()
        )->json();

        if (isset($response['success']) && $response['success'] == true) {

            session(['UserSession.domain.hosting' => now()->addMinutes(30)]);

            Flasher::success(__('site.flasher.success_domain_hosting'));
        } else {

            $msg = $response['errors']['code'] != '0000' ? __('site.flasher.' . $response['errors']['code']) : $response['errors']['msg'];

            Flasher::error($msg);
        }

        return back()->withInput();
    }

    public function getRenew($uuid)
    {

        if ($uuid) {

            $response = Http::withHeaders(Helpy::authToken())->post(
                Helpy::apiEndpoint() . '/user/domain/renew/' . $uuid
            )->json();

            if (isset($response['success']) && $response['success'] == true) {

                Flasher::success(__('site.flasher.success_domain_renew'));

                return redirect()->route('Site-CartGetShow');
            } else {

                Flasher::error(__('site.flasher.' . $response['errors']['code']));
            }
        } else {

            Flasher::error(__('site.flasher.error_renew'));
        }

        return redirect()->back();
    }

    public function postDelete($uuid)
    {

        if (session('UserSession.domain.hosting') > now()) {

            Flasher::info(__('site.wording.record_operation'));
            return back()->withInput();
        }

        $response = Http::withHeaders(Helpy::authToken())->post(
            Helpy::apiEndpoint() . '/user/domain/delete/' . $uuid,
        )->json();

        if (isset($response['success']) && $response['success'] == true) {

            Flasher::success(__('site.flasher.success_domain_delete'));

            return redirect()->route('Site-DomainGetShow');
        } else {

            $msg = $response['errors']['code'] != '0000' ? __('site.flasher.' . $response['errors']['code']) : $response['errors']['msg'];

            Flasher::error($msg);

            return back()->withInput();
        }
    }
}
