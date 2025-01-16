<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // ตรวจสอบว่า user เป็น 'Admin' หรือไม่
        if (Auth::check() && Auth::user()->status === 'Admin') {
            return $next($request); // ถ้าเป็น Admin ให้ดำเนินการต่อไป
        }

        // หากไม่ใช่ Admin จะ redirect ไปยังหน้าอื่น
        return redirect('/home'); // หรือกำหนดเส้นทางอื่นๆ ที่ต้องการ
    }
}
