<?php

namespace App\Http\Middleware;

use Closure;
use Spatie\Permission\Exceptions\UnauthorizedException;

class Permission
{
    public function handle($request, Closure $next, $permission)
    {
        if (app('auth')->guest()) {
            return redirect('/');
        }

        $permissions = is_array($permission)
            ? $permission
            : explode('|', $permission);

        foreach ($permissions as $permission) {
            if (app('auth')->user()->can($permission)) {
                return $next($request);
            }
        }

        return redirect('/');
    }
}
