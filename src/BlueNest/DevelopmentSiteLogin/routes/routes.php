<?php

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Cookie;

Route::group(['middleware' => ['web']], function () {
    Route::get('development-site-login', function () {
        return view('development-site-login::development-site-login-page');
    });

    Route::post('development-site-login', function () {
        if(Input::get('site-pin') === env('DEV_SITE_PIN', null)) {
            $cookie = Cookie::forever('dev-site-login-cookie', env('DEV_SITE_PIN_COOKIE_VALUE', 'default-cookie-value'));
            return redirect('/')->withCookie($cookie);
        } else {
            return view('development-site-login::development-site-login-page');
        }
    });

    Route::get('development-site-login/logout', function () {
        return redirect('development-site-login')->withCookie(Cookie::forget('dev-site-login-cookie'));
    });
});