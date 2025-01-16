<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agency;

class AgencyController extends Controller
{
    // แสดงรายการ Agency ทั้งหมด
    public function index()
    {
        $agencies = Agency::all(); // ดึงข้อมูลหน่วยงานทั้งหมดจากฐานข้อมูล
        return view('agency.index', compact('agencies'));
    }

    // แสดงหน้าเพิ่มหน่วยงาน
    public function create()
    {
        return view('agency.create');
    }

    // บันทึกข้อมูลหน่วยงานใหม่ลงฐานข้อมูล
    public function store(Request $request)
    {
        // ตรวจสอบข้อมูลที่ส่งมา
        $request->validate([
            'agency_name' => 'required|string|max:255',
        ]);

        // บันทึกข้อมูล
        Agency::create([
            'agency_name' => $request->agency_name,
        ]);

        // Redirect พร้อมแสดงข้อความสำเร็จ
        return redirect()->route('agency.index')->with('success', 'เพิ่มหน่วยงานสำเร็จ');
    }

    // แสดงหน้าแก้ไขหน่วยงาน
    public function edit($id)
    {
        $agency = Agency::findOrFail($id); // ค้นหา Agency ตาม id
        return view('agency.edit', compact('agency'));
    }

    // บันทึกข้อมูลที่แก้ไขลงฐานข้อมูล
    public function update(Request $request, $id)
    {
        // ตรวจสอบข้อมูลที่ส่งมา
        $request->validate([
            'agency_name' => 'required|string|max:255',
        ]);

        // ค้นหา Agency และอัปเดตข้อมูล
        $agency = Agency::findOrFail($id);
        $agency->update([
            'agency_name' => $request->agency_name,
        ]);

        // Redirect พร้อมแสดงข้อความสำเร็จ
        return redirect()->route('agency.index')->with('success', 'แก้ไขหน่วยงานสำเร็จ');
    }
}
