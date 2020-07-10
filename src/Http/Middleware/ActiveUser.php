<?php

namespace Skoro\AdminPack\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Skoro\AdminPack\Models\User;

/**
 * This middleware checks the user's status.
 * 
 * When the status is disabled it logouts the user immediately
 * and redirects to the login form.
 */
class ActiveUser
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
        $user = auth_admin()->user();
        if ($user && $user->status == User::STATUS_ACTIVE) {
            return $next($request);
        }

        auth_admin()->logout();

        alert('error', __('User has been disabled.'), false);

        throw new AuthenticationException(
            'User has been disabled.', ['admin'], route('admin.login')
        );
    }
}
