<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\NewsType;
use App\Models\Agency;
use App\Models\NewsFile;

class ViewNewsController extends Controller
{
    /**
     * แสดงรายการข่าวทั้งหมด
     */
    public function index(Request $request)
    {
        // เรียกข้อมูลข่าวและความสัมพันธ์
        $query = News::with(['news_type', 'agency' ,'user']);
    
        // ค้นหาโดย news_type (type_name)
        if ($request->filled('news_type')) {
            $query->whereHas('news_type', function ($q) use ($request) {
                $q->where('type_name', 'like', '%' . $request->news_type . '%');
            });
        }
    
        // ค้นหาโดย agency (agency_name)
        if ($request->filled('agency')) {
            $query->whereHas('agency', function ($q) use ($request) {
                $q->where('agency_name', 'like', '%' . $request->agency . '%');
            });
        }
    
        // ค้นหาโดย news_title
        if ($request->filled('news_title')) {
            $query->where('news_title', 'like', '%' . $request->news_title . '%');
        }
    
        // ดึงข้อมูลเรียงลำดับจากใหม่ไปเก่า พร้อมแบ่งหน้า
        $newsList = $query->orderBy('created_at', 'desc')->paginate(16);
    
        return view('viewNews.index', compact('newsList'));
    }

    /**
     * แสดงรายละเอียดข่าวเฉพาะ ID
     */
    public function show($id)
    {
        // โหลดข่าว พร้อมกับไฟล์ข่าวที่เกี่ยวข้อง
        $news = News::with('newsFiles')->findOrFail($id);
    
        // เพิ่มจำนวนการอ่าน
        $news->increment('views');
    
        // ดึงข่าวแบบสุ่ม
        $randomNews = News::where('id', '!=', $id)
                        ->inRandomOrder()
                        ->limit(4)
                        ->get();
    
        return view('viewNews.show', compact('news', 'randomNews'));
    }


}
