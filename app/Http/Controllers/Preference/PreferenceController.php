<?php

namespace App\Http\Controllers\Preference;

use App\Http\Controllers\Controller;
use App\myClass\Flasher;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;

class PreferenceController extends Controller
{
    public function getLanguage($locale)
    {

        $locale = ($locale == 'en') ? 'en' : 'fr';

        $data = Cookie::get('preference', '[]');
        $data = json_decode($data, true);
        $data['language'] = $locale;

        Cookie::queue('preference', json_encode($data), now()->diffInMinutes(now()->addMonths(12)));

        App::setLocale($locale);
        Flasher::success(__('site.flasher.change_language'));
        return redirect()->to(url()->previous());
    }

    public function getcurrency($iso)
    {

        $iso = in_array($iso, ['xof', 'eur', 'usd']) ? $iso : 'xof';

        $data = Cookie::get('preference', '[]');
        $data = json_decode($data, true);
        $data['currency'] = $iso;

        Cookie::queue('preference', json_encode($data), now()->diffInMinutes(now()->addMonths(12)));

        Flasher::success(__('site.flasher.change_currency'));
        return redirect()->to(url()->previous());
    }
}
