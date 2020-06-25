<?php

namespace Skoro\AdminPack\Http\Middleware;

use Closure;

/**
 * Redirects logged in admin users to the admin home page.
 */
class RedirectIfAuthenticated
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
        if (auth_admin()->check()) {
            return redirect()->route('admin.home');
        }

        return $next($request);
    }
}
