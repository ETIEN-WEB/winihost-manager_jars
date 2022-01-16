<?php

if (!function_exists('cdn_asset')) {
    function cdn_asset($path, $https = true, $base_url = 'CDN_BASE_URL')
    {
        $https = ($https == true) ? 'https://' : 'http://';
        $url = $https . config('myconfig.' . $base_url) . $path;
        return $url;
    }
}
