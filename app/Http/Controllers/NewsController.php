<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsType;
use App\Models\Agency;
use App\Models\NewsFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
{
    $query = News::with(['news_type', 'agency', 'user']);

    // ค้นหาหัวข้อข่าว
    if ($request->filled('search_title')) {
        $query->where('news_title', 'like', '%' . $request->search_title . '%');
    }

    // ค้นหาประเภทข่าว
    if ($request->filled('news_type')) {
        $query->where('news_type_id', $request->news_type);
    }

    // ค้นหาสถานะข่าว
    if ($request->filled('news_status')) {
        $query->where('news_status', $request->news_status);
    }

    $news = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();
    $news_type = NewsType::get();

    return view('news.index', compact('news', 'news_type'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $newsTypes = NewsType::all();
        $agencies = Agency::all();
        return view('news.create', compact('newsTypes', 'agencies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'news_title' => 'nullable|string|max:255',
            'news_link' => 'nullable|url',
            'news_detail' => 'nullable',
            'news_status' => 'nullable|in:start,stop',
            'start_announcing' => 'nullable|date',
            'end_announcing' => 'nullable|date|after_or_equal:start_announcing',
            'news_type_id' => 'nullable|exists:news_type,id',
            'agency_id' => 'nullable|exists:agency,id',
            'files.*' => 'nullable|file|mimes:jpg,png,pdf,mp4,avi,mov',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // บันทึกข่าวพร้อมกับ user_id
        $news = News::create(array_merge($request->all(), [
            'user_id' => auth()->id(),
        ]));

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('files/news'), $filename);

                NewsFile::create([
                    'news_id' => $news->id,
                    'news_file' => $filename,
                ]);
            }
        }

        return redirect()->route('news.index')->with('success', 'เพิ่มข่าวเรียบร้อยแล้ว');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $news = News::findOrFail($id);
        $newsTypes = NewsType::all();
        $agencies = Agency::all();
        return view('news.edit', compact('news', 'newsTypes', 'agencies'));
    }

    public function update(Request $request, $id)
{
    $validator = Validator::make($request->all(), [
        'news_title' => 'nullable|string|max:255',
        'news_link' => 'nullable|url',
        'news_detail' => 'nullable',
        'news_status' => 'nullable|in:start,stop',
        'start_announcing' => 'nullable|date',
        'end_announcing' => 'nullable|date|after_or_equal:start_announcing',
        'news_type_id' => 'nullable|exists:news_type,id',
        'agency_id' => 'nullable|exists:agency,id',
        'files.*' => 'nullable|file|mimes:jpg,png,pdf,mp4,avi,mov',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    $news = News::findOrFail($id);

    // อัปเดตข้อมูลข่าว รวมถึง news_type_id และ agency_id
    $news->update($request->only([
        'news_title',
        'news_link',
        'news_detail',
        'news_status',
        'start_announcing',
        'end_announcing',
        'news_type_id',
        'agency_id',
    ]));

    // ลบไฟล์ที่เลือก
    if ($request->has('delete_files')) {
        foreach ($request->delete_files as $fileId) {
            $file = NewsFile::find($fileId);
            if ($file) {
                $filePath = public_path('files/news/' . $file->news_file);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
                $file->delete();
            }
        }
    }

    // เพิ่มไฟล์ใหม่
    if ($request->hasFile('files')) {
        foreach ($request->file('files') as $file) {
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('files/news'), $filename);

            NewsFile::create([
                'news_id' => $news->id,
                'news_file' => $filename,
            ]);
        }
    }

    return redirect()->route('news.index')->with('success', 'อัปเดตข่าวสำเร็จ');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $news = News::findOrFail($id);
        $news->delete();

        return redirect()->route('news.index')->with('success', 'ลบข่าวเรียบร้อยแล้ว');
    }
}
