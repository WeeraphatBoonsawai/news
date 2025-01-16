<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\NewsType;
use App\Models\Agency;
use App\Models\NewsFile;
use App\Models\Wreath;

use App\Models\FuneralNews;
use App\Models\Note;

class HomeController extends Controller
{
    public function index()
{
    $news = News::with(['news_type', 'agency'])
                ->orderBy('created_at', 'desc')
                ->paginate(4); // ตรวจสอบว่า paginate() ถูกตั้งค่าถูกต้อง

    $newsTypes = NewsType::all();

    // ข่าวด่วน
    $breakingNews = News::with(['news_type', 'agency'])
        ->whereHas('news_type', function ($query) {
            $query->where('type_name', 'ข่าวด่วน');
        })
        ->orderBy('created_at', 'desc')
        ->take(6)
        ->get();

    // ข่าวเชิญประชุม
    $inviteNews = News::with(['news_type', 'agency'])
    ->whereHas('news_type', function ($query) {
        $query->where('type_name', 'เชิญประชุม');
    })
    ->orderBy('created_at', 'desc')
    ->take(4)
    ->get();

   // ข่าวประเภทวิดีโอ
    $videoNews = News::with(['news_type', 'agency'])
   ->whereHas('news_type', function ($query) {
       $query->where('type_name', 'วิดีโอ');
   })
   ->orderBy('created_at', 'desc')
   ->take(4)
   ->get();

    $activityNews = News::with(['newsFiles', 'news_type'])
    ->where('news_type_id', 15) // เลือกเฉพาะ "ภาพกิจกรรม"
    ->orderBy('created_at', 'desc')
    ->get();


    // แยกข่าวล่าสุด (ภาพใหญ่) และข่าวอื่นๆ (ภาพย่อย)
    $mainActivityNews = $activityNews->first(); // ข่าวหลัก
    $otherActivityNews = $activityNews->take(5)->slice(1); // เอาข่าวที่เหลือ

    // ข่าวศพ
    $funeralgNews = FuneralNews::with('notes')
        ->orderBy('created_at', 'desc')
        ->take(4)
        ->get();

return view('welcome', compact(
    'news', 
    'newsTypes', 
    'breakingNews', 
    'videoNews', 
    'inviteNews', 
    'mainActivityNews', 
    'otherActivityNews' , 
    'activityNews',
    'funeralgNews'
));
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
    
        return view('viewNews.show', compact('news'));
    }


public function showFuneralNews($id)
{
    // ค้นหา FuneralNews ตาม ID และโหลด notes ที่เกี่ยวข้อง
    $funeralNews = FuneralNews::with(['notes', 'wreath'])->findOrFail($id);

    // เพิ่มจำนวนการอ่าน
    $funeralNews->increment('views');

    return view('viewNews.funeralshow', compact('funeralNews'));
}


    
}
