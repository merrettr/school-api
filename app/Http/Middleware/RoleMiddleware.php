<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

/**
 * Checks that the user making the current request has the specified role
 *
 * Class RoleMiddleware
 * @package App\Http\Middleware
 */
class RoleMiddleware {
    public function handle(Request $request, Closure $next, string $role) {
        if (!$request->user()->hasRole($role)) {
            return response([
                'code' => 403,
                'error' => 'Forbidden',
            ], 403);
        }

        return $next($request);
    }
}