<?php

namespace App\Http\Middleware;

use App\Http\Service\RsaService;
use App\Http\Service\SSORefererService;
use Closure;

class SSOReferer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if($request->get('referer') == 'app')
        {
            $data = RsaService::instance()->decrypt($request->get('data'));
            SSORefererService::setSSORefererAppId($data['app_id']);
            SSORefererService::setSSOCallbackUrl($data['callback']);
            SSORefererService::setCallbackParam($data['callback_param']);
        }
        return $next($request);
    }
}
