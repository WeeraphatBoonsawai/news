<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FuneralNews;

class FuneralController extends Controller
{
    /**
     * แสดงรายการงานศพทั้งหมดพร้อมการค้นหาและการจัดเรียง
     */
    public function index(Request $request)
    {
        // เริ่มต้น Query
        $query = FuneralNews::query();

        // ตรวจสอบเงื่อนไขการค้นหา
        if ($request->filled('officer_name')) {
            $query->where('officer_name', 'like', '%' . $request->officer_name . '%');
        }

        if ($request->filled('deceased')) {
            $query->where('deceased', 'like', '%' . $request->deceased . '%');
        }

        if ($request->filled('funeral_location')) {
            $query->where('funeral_location', 'like', '%' . $request->funeral_location . '%');
        }

        // เรียงลำดับ (ใช้คอลัมน์ที่มีอยู่ในฐานข้อมูล)
        $funeralList = $query
            ->orderBy('start_funeral', 'desc') // เรียงตามวันที่เริ่มงานศพ
            ->paginate(12);

        // ส่งข้อมูลไปยัง View
        return view('viewFuneral.index', compact('funeralList'));
    }

    public function show($id)
{
    // ดึงข้อมูลงานศพตาม ID
    $funeral = FuneralNews::findOrFail($id);

    // เพิ่มจำนวนการอ่าน
    $funeral->increment('views');

    // ส่งข้อมูลไปยัง View
    return view('viewFuneral.show', compact('funeral'));
}
}
