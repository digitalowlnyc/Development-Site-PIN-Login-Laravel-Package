<?php

namespace BlueNest\DevelopmentSiteLogin\Middleware;

use Closure;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Log;

class DevelopmentSiteIpRestrictionMiddleware
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
        $ipList = env('DEV_SITE_IP_LIST', null);

        if($ipList === null) {
            return $next($request);
        }

        $ipListArray = explode(',', trim($ipList));

        if(in_array($request->ip(), $ipListArray)) {
            return $next($request);
        } else {
            Log::info(get_class($this) . ': Access denied for ip: ' . $request->ip());
            return Response::make('Please contact an administrator');
        }
    }
}
