<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//------------------------- Page Auth ------------------------------//
Route::group(['prefix' => '/', 'namespace' => 'Auth'], function () {

    Route::group(['prefix' => '/', 'middleware' => ['notAuth']], function () {

        //------------------------- Page Auth-Login ------------------------------//
        Route::group(['prefix' => '/login', 'namespace' => 'Login'], function () {

            Route::get('/', ['as' => 'Auth-LoginGetShow', 'uses' => 'LoginController@getShow']);
            Route::post('/', ['as' => 'Auth-LoginPostShow', 'uses' => 'LoginController@postShow']);
        });

        //------------------------- Page Auth-Register ------------------------------//
        Route::group(['prefix' => '/register', 'namespace' => 'Register'], function () {

            Route::get('/', ['as' => 'Auth-RegisterGetShow', 'uses' => 'RegisterController@getShow']);
            Route::post('/', ['as' => 'Auth-RegisterPostShow', 'uses' => 'RegisterController@postShow']);
        });

        //------------------------- Page Auth-Activer ----------------------//
        Route::group(['prefix' => '/activer', 'namespace' => 'Activer'], function () {

            Route::get('/', ['as' => 'Auth-ActiverGetShow', 'uses' => 'ActiverController@getShow']);
            Route::post('/', ['as' => 'Auth-ActiverPostShow', 'uses' => 'ActiverController@postShow']);

            Route::get('/{code}', ['as' => 'Auth-ActiverGetAction', 'uses' => 'ActiverController@getAction']);
        });

        //------------------------- Page Auth-Password ----------------------//
        Route::group(['prefix' => '/password', 'namespace' => 'Password'], function () {

            Route::get('/', ['as' => 'Auth-PasswordGetShow', 'uses' => 'PasswordController@getShow']);
            Route::post('/', ['as' => 'Auth-PasswordPostShow', 'uses' => 'PasswordController@postShow']);

            Route::get('/reset/{uuid}', ['as' => 'Auth-PasswordGetReset', 'uses' => 'PasswordController@getReset']);
            Route::post('/reset/{uuid}', ['as' => 'Auth-PasswordPostReset', 'uses' => 'PasswordController@postReset']);
        });
    });

    //------------------------- Page Autologin ------------------------------//
    Route::group(['prefix' => '/autologin', 'namespace' => 'Autologin'], function () {

        Route::get('/', ['as' => 'Auth-AutologinGetShow', 'uses' => 'AutologinContoller@getShow']);
    });

    //------------------------- Page de deconnexion ------------------------------//
    Route::group(['prefix' => '/logout', 'namespace' => 'Logout', 'middleware' => ['apiAuth']], function () {

        Route::get('/', ['as' => 'Auth-LogoutGetShow', 'uses' => 'LogoutController@getShow']);
    });
});

//------------------------- Page Site ------------------------------//
Route::group(['prefix' => '/', 'namespace' => 'Site', 'middleware' => ['apiAuth']], function () {

    //------------------------- Page Site-Home ------------------------------//
    Route::group(['prefix' => '/', 'namespace' => 'Home'], function () {

        Route::get('/', ['as' => 'Site-HomeGetShow', 'uses' => 'HomeController@getShow']);
    });

    //------------------------- Page profile ------------------------------//
    Route::group(['prefix' => '/profile', 'namespace' => 'Profile'], function () {

        Route::post('/update', ['as' => 'Site-ProfilePostUpdate', 'uses' => 'ProfileController@postUpdate']);
        Route::post('/password', ['as' => 'Site-ProfilePostPassword', 'uses' => 'ProfileController@postPassword']);
    });

    //------------------------- Page Site-Session ------------------------------//
    Route::group(['prefix' => '/session', 'namespace' => 'Session'], function () {

        Route::post('/delete/{uuid}', ['as' => 'Site-SessionPostDelete', 'uses' => 'SessionController@postDelete']);
    });

    //------------------------- Page Site-Subscription ------------------------------//
    Route::group(['prefix' => '/subscription', 'namespace' => 'Subscription'], function () {

        Route::get('/', ['as' => 'Site-SubscriptionGetShow', 'uses' => 'SubscriptionController@getShow']);
    });

    //------------------------- Page Site-point ------------------------------//
    Route::group(['prefix' => '/point', 'namespace' => 'Point'], function () {

        Route::get('/', ['as' => 'Site-PointGetShow', 'uses' => 'PointController@getShow']);
    });

    //------------------------- Page Site-Order ------------------------------//
    Route::group(['prefix' => '/order', 'namespace' => 'Order'], function () {

        Route::get('/', ['as' => 'Site-OrderGetShow', 'uses' => 'OrderController@getShow']);
        Route::post('/generate', ['as' => 'Site-OrderPostGenerate', 'uses' => 'OrderController@postGenerate']);
        Route::get('/detail/{uuid}', ['as' => 'Site-OrderGetDetail', 'uses' => 'OrderController@getDetail']);
    });

    //------------------------- Page Site-notification ------------------------------//
    Route::group(['prefix' => '/notification', 'namespace' => 'Notification'], function () {

        Route::get('/', ['as' => 'Site-NotificationGetShow', 'uses' => 'NotificationController@getShow']);
        Route::get('/detail/{uuid}', ['as' => 'Site-NotificationGetDetail', 'uses' => 'NotificationController@getDetail']);
        Route::post('/delete/{uuid}', ['as' => 'Site-NotificationPostDelete', 'uses' => 'NotificationController@postDelete']);
        Route::post('/empty', ['as' => 'Site-NotificationPostEmpty', 'uses' => 'NotificationController@postEmpty']);
    });

    //------------------------- Page Site-ticket ------------------------------//
    Route::group(['prefix' => '/ticket', 'namespace' => 'Ticket'], function () {

        Route::get('/', ['as' => 'Site-TicketGetShow', 'uses' => 'TicketController@getShow']);
        Route::get('/faq', ['as' => 'Site-TicketGetFaq', 'uses' => 'TicketController@getFaq']);
        Route::get('/ajax', ['as' => 'Site-TicketGetAjax', 'uses' => 'TicketController@getAjax']);
        Route::get('/create', ['as' => 'Site-TicketGetCreate', 'uses' => 'TicketController@getCreate']);
        Route::post('/create', ['as' => 'Site-TicketPostCreate', 'uses' => 'TicketController@postCreate']);
        Route::get('/detail/{uuid}', ['as' => 'Site-TicketGetDetail', 'uses' => 'TicketController@getDetail']);
        Route::post('/response/{uuid}', ['as' => 'Site-TicketPostMessage', 'uses' => 'TicketController@postMessage']);
        Route::post('/close/{uuid}', ['as' => 'Site-TicketPostClose', 'uses' => 'TicketController@closeTicket']);
    });

    //------------------------- Page Site-service ------------------------------//
    Route::group(['prefix' => '/service', 'namespace' => 'Service'], function () {

        Route::get('/', ['as' => 'Site-ServiceGetShow', 'uses' => 'ServiceController@getShow']);
        Route::get('/detail/{service}', ['as' => 'Site-ServiceGetDetail', 'uses' => 'ServiceController@getDetail']);
        Route::get('/subscribe/{service}/{package}', ['as' => 'Site-ServiceGetSubscribe', 'uses' => 'ServiceController@getSubscribe']);
        Route::get('/suite/{service}', ['as' => 'Site-ServiceGetSuite', 'uses' => 'ServiceController@getSuite']);
    });

    //------------------------- Page Site-cart ------------------------------//
    Route::group(['prefix' => '/cart', 'namespace' => 'Cart'], function () {

        Route::get('/', ['as' => 'Site-CartGetShow', 'uses' => 'CartController@getShow']);
        Route::get('/renew-all', ['as' => 'Site-CartGetRenewAll', 'uses' => 'CartController@getRenewAll']);
        Route::post('/update/{uuid}', ['as' => 'Site-CartPostUpdate', 'uses' => 'CartController@postUpdate']);
        Route::post('/delete/{uuid}', ['as' => 'Site-CartPostDelete', 'uses' => 'CartController@getDelete']);
        Route::post('/check-code', ['as' => 'Site-CartPostCheckCode', 'uses' => 'CartController@checkCode']);
    });

    //------------------------- Hosting ------------------------------//
    Route::group(['prefix' => '/hosting', 'namespace' => 'Hosting'], function () {

        Route::get('/', ['as' => 'Site-HostingGetShow', 'uses' => 'HostingController@getShow']);
        Route::get('/detail/{uuid}', ['as' => 'Site-HostingGetDetail', 'uses' => 'HostingController@getDetail']);
        Route::get('/renew/{uuid}', ['as' => 'Site-HostingGetRenew', 'uses' => 'HostingController@getRenew']);
    });

    //------------------------- Monitoring ------------------------------//
    Route::group(['prefix' => '/monitoring', 'namespace' => 'Monitoring'], function () {

        Route::get('/', ['as' => 'Site-MonitoringGetShow', 'uses' => 'MonitoringController@getShow']);
        Route::get('/create', ['as' => 'Site-MonitoringGetCreate', 'uses' => 'MonitoringController@getCreate']);
        Route::post('/create', ['as' => 'Site-MonitoringPostCreate', 'uses' => 'MonitoringController@postCreate']);
        Route::post('/delete/{uuid}', ['as' => 'Site-MonitoringPostDelete', 'uses' => 'MonitoringController@postDelete']);
        Route::get('/detail/{uuid}', ['as' => 'Site-MonitoringGetDetail', 'uses' => 'MonitoringController@getDetail']);
        Route::get('/edite/{uuid}', ['as' => 'Site-MonitoringGetEdite', 'uses' => 'MonitoringController@getEdite']);
        Route::post('/edite/{uuid}', ['as' => 'Site-MonitoringPostEdite', 'uses' => 'MonitoringController@postEdite']);
    });

    //------------------------- Scanfolder ------------------------------//
    Route::group(['prefix' => '/scanfolder', 'namespace' => 'Scanfolder'], function () {

        Route::get('/', ['as' => 'Site-ScanfolderGetShow', 'uses' => 'ScanfolderController@getShow']);
        Route::get('/detail/{uuid}', ['as' => 'Site-ScanfolderGetDetail', 'uses' => 'ScanfolderController@getDetail']);
        Route::get('/renew/{uuid}', ['as' => 'Site-ScanfolderGetRenew', 'uses' => 'ScanfolderController@getRenew']);

        Route::get('/item-create/{uuid}', ['as' => 'Site-ScanfolderGetCreteItem', 'uses' => 'ScanfolderController@getItemCrete']);
        Route::post('/item-create/{uuid}', ['as' => 'Site-ScanfolderPostCreteItem', 'uses' => 'ScanfolderController@postItemCrete']);

        Route::post('/item-detail', ['as' => 'Site-ScanfolderGetDetailItem', 'uses' => 'ScanfolderController@getItemDetail']);

        Route::get('/item-edit/{uuid}', ['as' => 'Site-ScanfolderGetEdite', 'uses' => 'ScanfolderController@getEdite']);
        Route::post('/item-edite/{uuid}', ['as' => 'Site-ScanfolderPostEdite', 'uses' => 'ScanfolderController@postEdite']);

        Route::post('/item-delete/{sacnfolder}/{uuid}', ['as' => 'Site-ScanfolderPostDelete', 'uses' => 'ScanfolderController@postDelete']);
    });


    //------------------------- Watcher ------------------------------//
    Route::group(['prefix' => '/watcher', 'namespace' => 'Watcher'], function () {

        Route::get('/', ['as' => 'Site-WatcherGetShow', 'uses' => 'WatcherController@getShow']);

        Route::post('/create', ['as' => 'Site-WatcherPostCreate', 'uses' => 'WatcherController@postCreate']);
        Route::post('/delete/{uuid}', ['as' => 'Site-WatcherPostDelete', 'uses' => 'WatcherController@postDelete']);
    });

    //------------------------- Domain ------------------------------//
    Route::group(['prefix' => '/domain', 'namespace' => 'Domain'], function () {

        Route::get('/', ['as' => 'Site-DomainGetShow', 'uses' => 'DomainController@getShow']);
        Route::get('/create', ['as' => 'Site-DomainGetCreate', 'uses' => 'DomainController@getCreate']);
        Route::post('/create', ['as' => 'Site-DomainPostCreate', 'uses' => 'DomainController@postCreate']);
        Route::get('/detail/{uuid}', ['as' => 'Site-DomainGetDetail', 'uses' => 'DomainController@getDetail']);
        Route::get('/renew/{uuid}', ['as' => 'Site-DomainGetRenew', 'uses' => 'DomainController@getRenew']);
        Route::post('/hosting/{uuid}', ['as' => 'Site-DomainPostHosting', 'uses' => 'DomainController@postHosting']);
        Route::post('/delete/{uuid}', ['as' => 'Site-DomainPostDelete', 'uses' => 'DomainController@postDelete']);

        Route::group(['prefix' => 'record', 'namespace' => 'Record'], function () {

            Route::get('/create/{uuid}', ['as' => 'Site-Domain-RecordGetCreate', 'uses' => 'RecordController@getCreate']);
            Route::post('/create/{uuid}', ['as' => 'Site-Domain-RecordPostCreate', 'uses' => 'RecordController@postCreate']);

            Route::get('/edite/{uuid}/{item}', ['as' => 'Site-Domain-RecordGetEdite', 'uses' => 'RecordController@getEdite']);
            Route::post('/edite/{uuid}/{item}', ['as' => 'Site-Domain-RecordPostEdite', 'uses' => 'RecordController@postEdite']);

            Route::post('/delete/{uuid}/{item}', ['as' => 'Site-Domain-RecordPostDelete', 'uses' => 'RecordController@postDelete']);
        });

        Route::group(['prefix' => 'dns', 'namespace' => 'Dns'], function () {

            Route::post('/ssl/{uuid}', ['as' => 'Site-Domain-DnsPostSsl', 'uses' => 'DnsController@postSsl']);
            Route::post('/https/{uuid}', ['as' => 'Site-Domain-DnsPostHttps', 'uses' => 'DnsController@postHttps']);
            Route::post('/cache/{uuid}', ['as' => 'Site-Domain-DnsPostCache', 'uses' => 'DnsController@postCache']);
            Route::post('/devmode/{uuid}', ['as' => 'Site-Domain-DnsPostDevmode', 'uses' => 'DnsController@postDevmode']);
            Route::post('/minify/{uuid}', ['as' => 'Site-Domain-DnsPostMinify', 'uses' => 'DnsController@postMinify']);
        });
    });
});

//------------------------- Page Preference ------------------------------//
Route::group(['prefix' => '/preference', 'namespace' => 'Preference'], function () {

    Route::get('/language/{local}', ['as' => 'PreferenceGetLanguage', 'uses' => 'PreferenceController@getLanguage']);
    Route::get('/currency/{iso}', ['as' => 'PreferenceGetcurrency', 'uses' => 'PreferenceController@getcurrency']);
});
