<?php

use Skoro\AdminPack\Models\Permission;
use Skoro\AdminPack\Models\Role;

if (! function_exists('auth_admin')) {
    /**
     * Returns authentication admin guard.
     *
     * @return \Illuminate\Auth\SessionGuard
     */
    function auth_admin()
    {
        return auth('admin');
    }
}

if (!function_exists('roles')) {
    /**
     * Returns all available roles ordered by name.
     *
     * @return Role[]
     */
    function roles()
    {
        return Role::orderBy('name', 'asc')->get();
    }
}

if (!function_exists('scope_permissions')) {
    /**
     * Returns permissions indexed by scope.
     */
    function scope_permissions()
    {
        return Permission::all()->groupBy('scope');
    }
}

if (!function_exists('toast')) {
    /**
     * Shows a short toast message.
     *
     * @param string $message
     * @param bool   $autohide Don't hide the toast.
     */
    function toast(string $message, bool $autohide = true)
    {
        $session = session();
        if ($session->has('toasts')) {
            $toasts = $session->get('toasts');
        } else {
            $toasts = [];
        }
        $toasts[] = [
            'message' => $message,
            'autohide' => $autohide,
        ];
        $session->flash('toasts', $toasts);
    }
}

if (! function_exists('alert')) {
    /**
     * Shows an alert.
     *
     * @param string $level The alert type: info, warn, error.
     * @param string $alert The alert message.
     * @param bool   $close The alert can be closed.
     */
    function alert(string $type, string $alert, bool $close = true)
    {
        $session = session();
        if ($session->has('alerts')) {
            $alerts = $session->get('alerts');
        } else {
            $alerts = [];
        }
        $alerts[] = [
            'message' => $alert,
            'type' => $type,
            'close' => $close,
        ];
        $session->flash('alerts', $alerts);
    }
}

if (! function_exists('option')) {
    /**
     * Gets or sets the option value.
     *
     * When null is passed as the key an instance of the Option model
     * is returned. When an array is passed then it will set values.
     * 
     * @param string|array|null $key
     * @param mixed             $default
     * @return mixed|\App\Models\Option
     */
    function option($key = null, $default = null)
    {
        if ($key === null) {
            return app('option');
        }

        if (is_array($key)) {
            return app('option')->set($key);
        }

        return app('option')->get($key, $default);
    }
}