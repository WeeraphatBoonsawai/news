<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        // รับค่าเดือนและปีที่ต้องการ หรือใช้ค่าปัจจุบันเป็นค่าเริ่มต้น
        $month = $request->input('month', Carbon::now()->format('m'));
        $year = $request->input('year', Carbon::now()->format('Y'));
    
        // ดึงข้อมูลข่าวที่มีจำนวน views ในช่วงเดือนที่เลือก และเลือก 10 อันดับแรก
        $newsData = DB::table('news')
            ->select('news_title', 'views')
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->orderBy('views', 'desc') // เรียงตาม views มากไปน้อย
            ->limit(10) // ดึงเฉพาะ 10 อันดับแรก
            ->get();
    
        // คำนวณยอดรวมจำนวนคนอ่านในเดือนนั้น
        $totalViews = DB::table('news')
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->sum('views'); // รวมจำนวน views ทั้งหมดในเดือนนั้น
    
        // จัดรูปแบบข้อมูลสำหรับกราฟ
        $labels = $newsData->pluck('news_title'); // ชื่อข่าว
        $data = $newsData->pluck('views'); // จำนวน views

        // นับจำนวนข่าวทั้งหมด
        $totalNews = DB::table('news')->count();

        // นับจำนวนผู้ใช้งานทั้งหมด
        $totalUsers = DB::table('users')->count(); // users คือชื่อของตารางผู้ใช้งาน
    
        return view('dashboard', compact('labels', 'data', 'month', 'year', 'totalViews', 'totalNews' , 'totalUsers'));
    }
}
