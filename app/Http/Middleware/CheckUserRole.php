<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // ตรวจสอบว่า user login และมีสถานะตรงกับ roles ที่กำหนดหรือไม่
        if (!auth()->check() || !in_array(auth()->user()->status, $roles)) {
            abort(403, 'Unauthorized access');
        }

        return $next($request);
    }
}
