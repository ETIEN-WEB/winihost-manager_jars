<?php

namespace App\Http\Controllers\Site\Ticket;

use App\Http\Controllers\Controller;
use App\myClass\Flasher;
use App\myClass\Helpy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Browser;
use Illuminate\Support\Str;

class TicketController extends Controller
{

    public function getShow()
    {

        $data['menu_active'] = 'ticket';
        $data['breadcrumb'] = [
            'Dashboad' => route('Site-HomeGetShow'),
            __('site.label.ticket') => null,
        ];

        // Appelle des modules via API
        $response = Helpy::callApiModule(['ticket_list']);

        if (isset($response['success']) && $response['success'] == true) {

            $data = array_merge($data, $response['result']);
        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));
            return back();
        }

        return view('page.site.ticket.show', $data);
    }

    public function getFaq()
    {

        $data['menu_active'] = 'ticket';
        $data['breadcrumb'] = [
            'Dashboad' => route('Site-HomeGetShow'),
            __('site.label.ticket') => null,
        ];

        // Appelle des modules via API
        $response = Helpy::callApiModule(['faq_response_list'], ['paginate' => 9999]);

        if (isset($response['success']) && $response['success'] == true) {

            $data = array_merge($data, $response['result']);
        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));
            return back();
        }

        return view('page.site.ticket.faq', $data);
    }

    public function getCreate()
    {

        $data['menu_active'] = 'ticket';
        $data['breadcrumb'] = [
            'Dashboad' => route('Site-HomeGetShow'),
            __('site.label.ticket') => null,
        ];

        // Appelle des modules via API
        $response = Helpy::callApiModule(['ticket_type', 'ticket_priority']);

        if (isset($response['success']) && $response['success'] == true) {

            $data = array_merge($data, $response['result']);
        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));
            return back();
        }

        return view('page.site.ticket.create', $data);
    }

    public function postCreate(Request $request)
    {

        $data = $request->all();

        if ($request->hasFile('file')) {
            $data['file'] =  'data:' . $request->file->getClientMimeType() . ';base64,' . base64_encode($request->file->get());
        }

        $response = Http::withHeaders(Helpy::authToken())->post(
            Helpy::apiEndpoint() . '/user/ticket/create',
            $data
        )->json();

        if (isset($response['success']) && $response['success'] == false) {

            Flasher::error(__('site.falsher.errors'));

            $name = Str::afterLast($response['errors']['msg'], ' ');

            return redirect()->back()->withInput()->withErrors([$name => __('site.flasher.' . $response['errors']['code'])]);
        }

        Flasher::success(__('site.flasher.success_ticket_create'));
        return redirect()->route('Site-TicketGetDetail', ['uuid' => $response['result']['uuid']]);
    }

    public function getDetail($uuid)
    {

        $data['menu_active'] = 'ticket';
        $data['breadcrumb'] = [
            'Dashboad' => route('Site-HomeGetShow'),
            __('site.label.ticket') => null,
        ];

        // Appelle des modules via API
        $response = Helpy::callApiModule(['ticket_list', 'ticket_message:' . $uuid]);

        if (isset($response['success']) && $response['success'] == true) {

            $data = array_merge($data, $response['result']);

            $data['ticket_detail'] = collect($response['result']['ticket_list'])->where('uuid', '=', $uuid)->first();
        } else {

            Flasher::error(__('site.flasher.' . $response['errors']['code']));
            return back();
        }

        return view('page.site.ticket.detail', $data);
    }

    public function postMessage(Request $request, $uuid)
    {

        $data = $request->all();

        if ($request->hasFile('file')) {
            $data['file'] =  'data:' . $request->file->getClientMimeType() . ';base64,' . base64_encode($request->file->get());
        }

        $response = Http::withHeaders(Helpy::authToken())->post(
            Helpy::apiEndpoint() . '/user/ticket/response/' . $uuid,
            $data
        )->json();

        if (isset($response['success']) && $response['success'] == false) {

            Flasher::error(__('site.falsher.errors'));

            $name = Str::afterLast($response['errors']['msg'], ' ');

            return redirect()->back()->withInput()->withErrors([$name => __('site.flasher.' . $response['errors']['code'])]);
        }

        Flasher::success(__('site.flasher.success_ticket_message'));
        return redirect()->route('Site-TicketGetDetail', ['uuid' => $uuid]);
    }

    public function closeTicket(Request $request, $uuid)
    {

        $response = Http::withHeaders(Helpy::authToken())->post(
            Helpy::apiEndpoint() . '/user/ticket/close/' . $uuid,
            [
                'rate_star' => $request->rate_star,
                'rate_message' => $request->rate_message,
            ]
        )->json();

        if (isset($response['success']) && $response['success'] == false) {

            Flasher::error(__('site.falsher.errors'));

            $name = Str::afterLast($response['errors']['msg'], ' ');

            return redirect()->back()->withInput()->withErrors([$name => __('site.flasher.' . $response['errors']['code'])]);
        }

        Flasher::success(__('site.flasher.success_ticket_close'));
        return redirect()->route('Site-TicketGetDetail', ['uuid' => $uuid]);
    }

    public function getAjax(Request $request)
    {
        if ($request->code == 1001) {
            return $request->data ? file_get_contents($request->data) : 'No data available';
        }
    }
}
