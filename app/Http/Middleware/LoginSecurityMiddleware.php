<?php

namespace App\Http\Middleware;

use App\Support\Google2FAAuthenticator;
use Closure;
use Auth;

class LoginSecurityMiddleware
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
        $option = getOption('googleAuthenticate');
        $isEnabled = $option['enabled'] ?? 0;
        if(!$isEnabled) {
            return $next($request);
        }
        $auth = Auth::guard('admin')->user();
        if($auth->google2fa_secret == '') {
            return redirect(route('admin.registerQr'));
        }
        $authenticator = app(Google2FAAuthenticator::class)->boot($request);
        if ($authenticator->isAuthenticated()) {
            return $next($request);
        }
        return $authenticator->makeRequestOneTimePasswordResponse();
    }
}
