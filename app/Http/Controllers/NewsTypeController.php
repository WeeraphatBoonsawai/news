<?php

namespace App\Http\Controllers;

use App\Models\NewsType;
use Illuminate\Http\Request;

class NewsTypeController extends Controller
{
    /**
     * แสดงรายการประเภทข่าว.
     */
    public function index()
    {
        $newsTypes = NewsType::all();
        return view('news_type.index', compact('newsTypes'));
    }

    /**
     * แสดงหน้าสร้างประเภทข่าว.
     */
    public function create()
    {
        return view('news_type.create');
    }

    /**
     * จัดการบันทึกประเภทข่าวใหม่.
     */
    public function store(Request $request)
    {
        $request->validate([
            'type_name' => 'required|string|max:255',
        ]);

        NewsType::create([
            'type_name' => $request->type_name,
        ]);

        return redirect()->route('news_type.index')->with('success', 'เพิ่มประเภทข่าวสำเร็จ!');
    }

    /**
     * แสดงหน้าฟอร์มแก้ไขประเภทข่าว.
     */
    public function edit($id)
    {
        $newsType = NewsType::findOrFail($id);
        return view('news_type.edit', compact('newsType'));
    }

    /**
     * จัดการอัปเดตประเภทข่าว.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'type_name' => 'required|string|max:255',
        ]);

        $newsType = NewsType::findOrFail($id);
        $newsType->update([
            'type_name' => $request->type_name,
        ]);

        return redirect()->route('news_type.index')->with('success', 'อัปเดตประเภทข่าวสำเร็จ!');
    }

}
