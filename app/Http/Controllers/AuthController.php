<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Enums\UserStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
    
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // ป้องกัน Session Fixation
    
            // เปลี่ยนเส้นทางไปยังหน้า Home
            return redirect()->intended(route('home.index')); // ตรวจสอบหากผู้ใช้ถูกเปลี่ยนเส้นทางจากที่อื่น
        }
    
        // กรณีที่ข้อมูลล็อกอินไม่ถูกต้อง
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }


    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8|confirmed',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'status' => UserStatus::USER->value,
        ]);

        return redirect('/')->with('success', 'Registration successful');
    }

    public function logout(Request $request)
    {
    Auth::logout(); // ล็อกเอาต์ผู้ใช้
    $request->session()->invalidate(); // ทำให้เซสชันปัจจุบันไม่สามารถใช้งานได้อีก
    $request->session()->regenerateToken(); // สร้าง CSRF Token ใหม่เพื่อความปลอดภัย

    // เปลี่ยนเส้นทางไปยัง Route 'home.index'
    return redirect()->route('home.index');
    }
}
