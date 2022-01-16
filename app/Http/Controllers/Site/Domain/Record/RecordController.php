<?php

namespace App\Http\Controllers\Site\Domain\Record;

use App\Http\Controllers\Controller;
use App\myClass\Flasher;
use App\myClass\Helpy;
use Illuminate\Http\Request;
use Browser;
use Illuminate\Support\Facades\Http;

class RecordController extends Controller
{

    public function getCreate($uuid)
    {

        if (session('UserSession.domain.hosting') > now()) {

            Flasher::info(__('site.wording.record_operation'));
            return back()->withInput();
        }

        // breadcrumb navidation
        $data['menu_active'] = 'subscription';
        $data['breadcrumb'] = [
            'Dashboad' => route('Site-HomeGetShow'),
            __('site.label.domain') => null,
        ];

        // Appelle des modules via API
        $response = Helpy::callApiModule(['domain_detail:' . $uuid, 'record_type']);

        if (isset($response['success']) && $response['success'] == true) {

            $data = array_merge($data, $response['result']);
        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));
            return back();
        }

        return view('page.site.domain.record.create', $data);
    }

    public function postCreate(Request $request, $uuid)
    {

        if (session('UserSession.domain.hosting') > now()) {

            Flasher::info(__('site.wording.record_operation'));
            return back()->withInput();
        }

        $response = Http::withHeaders(Helpy::authToken())->post(
            Helpy::apiEndpoint() . '/user/record/create/' . $uuid,
            $request->all()
        )->json();

        if (isset($response['success']) && $response['success'] == true) {

            Flasher::success(__('site.flasher.success_record_create'));

            return redirect()->route('Site-DomainGetDetail', ['uuid' => $uuid]);
        } else {

            $msg_code = $response['errors']['code'] ?? '0000';
            Flasher::error(__('site.flasher.' . $msg_code));

            return back()->withInput();
        }
    }

    public function getEdite($uuid, $item)
    {

        if (session('UserSession.domain.hosting') > now()) {

            Flasher::info(__('site.wording.record_operation'));
            return back()->withInput();
        }

        // breadcrumb navidation
        $data['menu_active'] = 'subscription';
        $data['breadcrumb'] = [
            'Dashboad' => route('Site-HomeGetShow'),
            __('site.label.domain') => null,
        ];

        // Appelle des modules via API
        $response = Helpy::callApiModule(['domain_detail:' . $uuid, 'record_type', 'domain_record:' . $uuid]);

        if (isset($response['success']) && $response['success'] == true) {

            $data = array_merge($data, $response['result']);
            $data['record_detail'] = collect($data['domain_record'])->where('uuid', '=', $item)->first();

            if (empty($data['record_detail'])) {
                Flasher::error(__('site.flasher.error_record_not_avaible'));
                return back();
            }
        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));
            return back();
        }

        return view('page.site.domain.record.edite', $data);
    }

    public function postEdite(Request $request, $uuid, $item)
    {

        if (session('UserSession.domain.hosting') > now()) {

            Flasher::info(__('site.wording.record_operation'));
            return back()->withInput();
        }

        $response = Http::withHeaders(Helpy::authToken())->post(
            Helpy::apiEndpoint() . '/user/record/edite/' . $uuid,
            $request->merge(['item' => $item])->all()
        )->json();

        if (isset($response['success']) && $response['success'] == true) {

            Flasher::success(__('site.flasher.success_record_edite'));

            return redirect()->route('Site-DomainGetDetail', ['uuid' => $uuid]);
        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));

            return back()->withInput();
        }
    }

    public function postDelete($uuid, $item)
    {

        if (session('UserSession.domain.hosting') > now()) {

            Flasher::info(__('site.wording.record_operation'));
            return back()->withInput();
        }

        $response = Http::withHeaders(Helpy::authToken())->post(
            Helpy::apiEndpoint() . '/user/record/delete/' . $uuid,
            ['item' => $item]
        )->json();

        if (isset($response['success']) && $response['success'] == true) {

            Flasher::success(__('site.flasher.success_record_edite'));

            return redirect()->route('Site-DomainGetDetail', ['uuid' => $uuid]);
        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));

            return back()->withInput();
        }
    }
}
