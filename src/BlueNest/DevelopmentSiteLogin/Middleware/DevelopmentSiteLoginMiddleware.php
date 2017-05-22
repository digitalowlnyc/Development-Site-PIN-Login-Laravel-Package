<?php

namespace BlueNest\DevelopmentSiteLogin\Middleware;

use Closure;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;

class DevelopmentSiteLoginMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $devSitePin = env("DEV_SITE_PIN", null);

        $devLoginPackageEnabled = $devSitePin !== null;

        if(!$devLoginPackageEnabled || strpos($request->url(), 'development-site-login') !== false) {
            return $next($request);
        }

        $cookieMatched = false;

        $cookieValue = Cookie::get('dev-site-login-cookie');
        if($cookieValue !== null) {
            $expectedCookieValue = env('DEV_SITE_PIN_COOKIE_VALUE', 'default-cookie-value');

            $cookieValues = array(
                $cookieValue,
                Crypt::decrypt($cookieValue)
            );

            foreach($cookieValues as $cookieValue) {
                if($cookieValue === $expectedCookieValue) {
                    $cookieMatched = true;
                    break;
                }
            }
        }

        if(!$cookieMatched) {
            return redirect('/development-site-login');
        } else {
            return $next($request);
        }
    }
}