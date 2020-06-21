<?php

namespace Skoro\AdminPack\Http\Middleware;

use Skoro\AdminPack\Facades\Option;
use Closure;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * This middleware determines whether the registration is enabled or not.
 * 
 * When the registration is disabled it gives a response with 404 code.
 */
class RegisterIsEnabled
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
        if (Option::get('user_register_enable', false)) {
            return $next($request);
        }

        throw new NotFoundHttpException();
    }
}
