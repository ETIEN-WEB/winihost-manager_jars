<?php

namespace App\Http\Controllers\Site\Scanfolder;

use App\Http\Controllers\Controller;
use App\myClass\Flasher;
use App\myClass\Helpy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ScanfolderController extends Controller
{
    public function getShow()
    {
        // breadcrumb navidation
        $data['menu_active'] = 'subscription';
        $data['breadcrumb'] = [
            'Dashboad' => route('Site-HomeGetShow'),
            __('site.label.scanfolder') => null,
        ];

        // Appelle des modules via API
        $response = Helpy::callApiModule(['scanfolder_list']);

        if (isset($response['success']) && $response['success'] == true) {

            $data = array_merge($data, $response['result']);
        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));
            return back();
        }
        //        dd($data);
        return view('page.site.scanfolder.show', $data);
    }

    public function getDetail($uuid)
    {
        // breadcrumb navidation
        $data['menu_active'] = 'monitoring';
        $data['breadcrumb'] = [
            'Dashboad' => route('Site-HomeGetShow'),
            __('site.label.scanfolder') => null,
        ];

        // Appelle des modules via API
        $response = Helpy::callApiModule(['scanfolder_detail:' . $uuid]);
        if (isset($response['success']) && $response['success'] == true) {

            $data = array_merge($data, $response['result']);
        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));
            return back();
        }
        return view('page.site.scanfolder.detail-item', $data);
    }

    public function getItemCrete(Request $request, $uuid)
    {
        $req = Helpy::callApiModule(['scanfolder_detail:' . $uuid]);

        if (isset($req['success']) && $req['success'] == false) {
            Flasher::error(__('site.flasher.' . $req['errors']['code']));
            return back();
        }
        // breadcrumb navidation
        $data['menu_active'] = 'subscription';
        $data['breadcrumb'] = [
            'Dashboad' => route('Site-HomeGetShow'),
            __('site.label.scanfolder') => null,
        ];
        // Appelle des modules via API
        $response = Helpy::callApiModule(['scanfolder_list']);

        if (isset($response['success']) && $response['success'] == true) {
            $data = array_merge($data, $response['result']);
        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));
            return back();
        }

        return view('page.site.scanfolder.create', $data);
    }

    public function postItemCrete(Request $request, $uuid)
    {

        $data = [
            'name' => $request->name,
            'scanfolder' => $uuid
        ];
        $ftp_dat = [
            'host' => $request->host,
            'username' => $request->user,
            'password' => $request->password,
            'port' => $request->port,
            'root' => $request->root,
            'excepts' => isset($request->excepts) ?  explode(',', $request->excepts) : [],
        ];
        $data['params'] = json_encode($ftp_dat);
        $response = Http::withHeaders(Helpy::authToken())->post(
            Helpy::apiEndpoint() . '/user/scanfolder/item-create',
            $data
        )->json();
        if (isset($response['success']) && $response['success'] == true) {
            Flasher::success(__('site.flasher.success_scanfolder_create'));

            return route('Site-ScanfolderGetDetail', ['uuid' => $response['result']['uuid']]);
        } else {
            Flasher::error(__('site.flasher.' . $response['errors']['code']));

            return back()->withInput();
        }
    }

    public function getEdite($uuid)
    {

        // breadcrumb navidation
        $data['menu_active'] = 'subscription';
        $data['breadcrumb'] = [
            'Dashboad' => route('Site-HomeGetShow'),
            __('site.label.scanfolder') => null,
        ];

        // Appelle des modules via API
        $response = Helpy::callApiModule(['scanfolder_item_detail:' . $uuid, 'scanfolder_list']);
        if (isset($response['success']) && $response['success'] == true) {

            $data = array_merge($data, $response['result']);
            if (empty($data['scanfolder_item_detail'])) {

                Flasher::error(__('site.flasher.error_monitoring_not_avaible'));
                return back();
            }
        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));
            return back();
        }

        return view('page.site.scanfolder.edite', $data);
    }

    public function postEdite(Request $request, $uuid)
    {
        $data = [
            'scanfolder' => $request->scanfolder,
            'name' => $request->name,
            'status' => isset($request->status) && $request->status == '1' ? 'true' : 'false',
        ];
        $ftp_dat = [
            'host' => $request->host,
            'username' => $request->user,
            'password' => $request->password,
            'port' => $request->port,
            'root' => $request->root,
            'excepts' => isset($request->excepts) ?  explode(',', $request->excepts) : [],
        ];
        $data['params'] = json_encode($ftp_dat);
        return Http::withHeaders(Helpy::authToken())->post(
            Helpy::apiEndpoint() . '/user/scanfolder/item-edite/' . $uuid,
            $data
        )->json();
    }

    public function postDelete($sacnfolder, $uuid)
    {
        $response = Http::withHeaders(Helpy::authToken())->post(
            Helpy::apiEndpoint() . '/user/scanfolder/item-delete/' . $uuid,
            [
                'scanfolder' => $sacnfolder,
            ]
        )->json();

        if (isset($response['success']) && $response['success'] == true) {

            Flasher::success(__('site.flasher.success_scanfolder_delete'));
        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));
        }

        return redirect()->route('Site-ScanfolderGetShow');
    }

    public function getRenew($uuid)
    {

        if ($uuid) {

            $response = Http::withHeaders(Helpy::authToken())->post(
                Helpy::apiEndpoint() . '/user/scanfolder/renew/' . $uuid
            )->json();

            if (isset($response['success']) && $response['success'] == true) {

                Flasher::success(__('site.flasher.success_scanfolder_renew'));

                return redirect()->route('Site-CartGetShow');
            } else {

                Flasher::error(__('site.flasher.' . $response['errors']['code']));
            }
        } else {

            Flasher::error(__('site.flasher.error_renew'));
        }
        return redirect()->back();
    }

    public function getItemDetail(Request $request)
    {
        $uuid = $request->uuid;
        if ($uuid) {
            // breadcrumb navidation
            $data['menu_active'] = 'subscription';
            $data['breadcrumb'] = [
                'Dashboad' => route('Site-HomeGetShow'),
                __('site.label.scanfolder') => null,
            ];
            $response = Helpy::callApiModule(['scanfolder_item_detail:' . $uuid]);
            if (isset($response['success']) && $response['success'] == true) {
                $data['scanfolder_item_detail'] = $response['result']['scanfolder_item_detail'];
                $data['flash_info_list'] = $response['result']['flash_info_list'];
                return response()->json(['success' => true, 'data' => $data, 'message' => []], 200);
            }
        }
        return response()->json(['success' => false, 'data' => [], 'message' => []], 422);
    }
}
