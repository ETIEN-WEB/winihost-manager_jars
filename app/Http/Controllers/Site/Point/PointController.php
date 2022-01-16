<?php

namespace App\Http\Controllers\Site\Point;

use App\Http\Controllers\Controller;
use App\myClass\Flasher;
use App\myClass\Helpy;
use Illuminate\Support\Facades\Http;
use Browser;

class PointController extends Controller
{


    public function getShow()
    {

        // breadcrumb navidation
        $data['menu_active'] = 'point';
        $data['breadcrumb'] = [
            'Dashboad' => route('Site-HomeGetShow'),
            __('site.label.point') => null,
        ];

        // Appelle des modules via API
        $response = Helpy::callApiModule(['point_detail']);

        if (isset($response['success']) && $response['success'] == true) {

            $data = array_merge($data, $response['result']);
        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));
            return back();
        }

        return view('page.site.point.show', $data);
    }
}
