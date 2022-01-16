<?php

namespace App\myClass;

use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
use Browser;

class Helpy
{

    static function formatDatetime(string $datetime, string $format = 'd/m/Y à H:i:s')
    {
        if (empty($datetime)) {
            return null;
        } else {
            return date($format, strtotime($datetime));
        }
    }

    static function localDatetime(string $datetime, string $local = 'fr')
    {
        if (empty($datetime)) {
            return null;
        } elseif ($local == 'fr') {
            return self::formatDatetime($datetime);
        } else {
            return self::formatDatetime($datetime, 'Y-m-d H:i:s');
        }
    }

    static function formatNumber(float $number, string $local = 'fr', int $decimals = 2)
    {

        if ($local == 'fr') {
            $dec_point = ',';
            $thousands_sep = ' ';
        } else {
            $dec_point = '.';
            $thousands_sep = ',';
        }

        return number_format($number, $decimals, $dec_point, $thousands_sep);
    }

    static function formatPrice(float $price_xof, bool $decimal = true)
    {

        $local = app()->getLocale();

        $iso = Cookie::get('preference', '[]');
        $iso = json_decode($iso, true);
        $iso = $iso['currency'] ?? 'xof';

        $currency = session('UserSession.app_info.currency.' . $iso);

        $price = $price_xof / $currency['rate'];
        $price = self::formatNumber($price, $local, $decimal == false ? 0 : 2);

        return $price . ' ' . $currency['symbol'];
    }

    static function breadcrumb(string $active, array $item): array
    {

        $data['menu_active'] = $active;
        $data['breadcrumb'] = array_merge(
            ['Dashboad' => route('Site-HomeGetShow')],
            $item
        );

        return $data;
    }

    static function authToken(): array
    {
        return [
            'X-Auth-Key' => session('UserSession.token.token_access'),
            'X-Auth-Email' => session('UserSession.token.token_email'),
        ];
    }

    static function apiEndpoint(): string
    {
        return config('myconfig.API_URL_SCHEMA') . config('myconfig.API_BASE_URL');
    }

    static function callApiModule(array $modules, array $params = []): array
    {

        if (!Browser::isMobile()) {
            $modules = array_merge($modules, ['flash_info_list']);
        }

        $response = Http::withHeaders(self::authToken())->post(
            config('myconfig.API_URL_SCHEMA') . config('myconfig.API_BASE_URL') . '/user/module/list',
            array_merge(['name' => implode(',', $modules)], $params)
        )->json();

        return $response;
    }
}
