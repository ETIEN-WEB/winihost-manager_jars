<?php

namespace App\myClass;

use Illuminate\Support\Facades\Session;

class Flasher
{

    static $msgFlash = 'MsgFlash';

    static function error(string $msg, string $title = 'Oups!')
    {
        return self::base('error', $title, $msg);
    }

    static function success(string $msg, string $title = 'Super!')
    {
        return self::base('success', $title, $msg);
    }

    static function info(string $msg, string $title = 'Info!')
    {
        return self::base('info', $title, $msg);
    }

    static function warning(string $msg, string $title = '')
    {
        return self::base('warning', $title, $msg);
    }

    static function base(string $type, string $title, string $msg)
    {
        return Session::flash(self::$msgFlash, [
            'type' => $type,
            'title' => $title,
            'msg' => $msg,
        ]);
    }
}
