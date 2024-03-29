<?php

namespace Modules\Admins\Http\Middleware;

use App\Helpers\Helpers;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class adminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!empty(Auth::guard("admins")->user()->id)){
            setcookie("php-post", "1", time() + (86400 * 30), "/");
        }else{
            setcookie("php-post", "0", time() + (86400 * 30), "/");
        }

        if (Auth::guard(Helpers::renderGuard())->check()) {
            View::share('admin', Auth::guard("admins")->user());
            return $next($request);
        }
        return redirect()->route('admin.login');
    }
}
