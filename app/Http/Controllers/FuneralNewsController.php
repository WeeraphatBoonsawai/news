<?php

namespace App\Http\Controllers;

use App\Models\FuneralNews;
use App\Models\Wreath;
use Illuminate\Http\Request;
use App\Models\Note;

class FuneralNewsController extends Controller
{
    /**
     * แสดงรายการข่าวงานศพทั้งหมด.
     */
    public function index(Request $request)
{
    $query = FuneralNews::query();

    // ค้นหาชื่อเจ้าหน้าที่
    if ($request->filled('search_officer')) {
        $query->where('officer_name', 'like', '%' . $request->search_officer . '%');
    }

    // ค้นหาชื่อผู้เสียชีวิต
    if ($request->filled('search_deceased')) {
        $query->where('deceased', 'like', '%' . $request->search_deceased . '%');
    }

    // ค้นหาสถานที่จัดงานศพ
    if ($request->filled('search_location')) {
        $query->where('funeral_location', 'like', '%' . $request->search_location . '%');
    }

    // ค้นหาสถานะ
    if ($request->filled('search_status')) {
        $query->where('funeral_news_status', $request->search_status);
    }

    $funeralNews = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

    return view('funeral_news.index', compact('funeralNews'));
}



     /**
 * แสดงฟอร์มเพิ่มข่าวงานศพใหม่.
 */
public function create()
{
    $wreaths = Wreath::all(); // โหลดข้อมูลพวงหรีดทั้งหมด
    return view('funeral_news.create', compact('wreaths'));
}

    /**
     * บันทึกข่าวงานศพใหม่.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'officer_name' => 'required|string|max:255',
        'officer_location' => 'required|string|max:255',
        'deceased' => 'required|string|max:255',
        'relationship' => 'required|string|max:255',
        'funeral_location' => 'required|string|max:255',
        'start_funeral' => 'nullable|date',
        'end_funeral' => 'nullable|date',
        'pray_funeral' => 'nullable',
        'cremation_ceremony' => 'nullable|date',
        'cremation_ceremon_location' => 'required|string|max:255',
        'funeral_news_status' => 'required|in:start,stop',
        'wreath_id' => 'required|exists:wreath,id',
        'notes.*' => 'nullable|string|max:255', // ตรวจสอบแต่ละหมายเหตุ
    ]);

    $funeralNews = FuneralNews::create($validated);

    // บันทึกหมายเหตุ
    if ($request->has('notes')) {
        foreach ($request->notes as $noteText) {
            if (!empty($noteText)) {
                $funeralNews->notes()->create(['note_text' => $noteText]);
            }
        }
    }

    return redirect()->route('funeral_news.index')->with('success', 'เพิ่มข่าวงานศพเรียบร้อยแล้ว');
}



    /**
     * แสดงฟอร์มแก้ไขข่าวงานศพ.
     */
    public function edit($id)
    {
        $funeralNews = FuneralNews::with('notes')->findOrFail($id);
        $wreaths = Wreath::all();
        return view('funeral_news.edit', compact('funeralNews', 'wreaths'));
    }

    /**
     * อัปเดตข่าวงานศพพร้อมจัดการหมายเหตุ.
     */
    public function update(Request $request, $id)
{
    $validated = $request->validate([
        'officer_name' => 'required|string|max:255',
        'officer_location' => 'required|string|max:255',
        'deceased' => 'required|string|max:255',
        'relationship' => 'required|string|max:255',
        'funeral_location' => 'required|string|max:255',
        'start_funeral' => 'nullable|date',
        'end_funeral' => 'nullable|date',
        'pray_funeral' => 'nullable|date_format:H:i',
        'cremation_ceremony' => 'nullable|date',
        'cremation_ceremon_location' => 'required|string|max:255',
        'funeral_news_status' => 'required|in:start,stop',
        'wreath_id' => 'required|exists:wreath,id',
        'notes.*.note_text' => 'nullable|string|max:255',
    ]);

    $funeralNews = FuneralNews::findOrFail($id);
    $funeralNews->update($validated);

    // จัดการ Notes
    if ($request->has('notes')) {
        foreach ($request->input('notes') as $noteId => $noteData) {
            if (isset($noteData['_delete']) && $noteData['_delete'] == '1') {
                // ตรวจสอบและลบ Note ที่ถูก flag ไว้
                Note::where('id', $noteId)->where('funeral_news_id', $funeralNews->id)->delete();
                continue;
            }

            // อัปเดต Note ที่มีอยู่
            if ($noteId !== 'new' && isset($noteData['note_text'])) {
                Note::where('id', $noteId)->where('funeral_news_id', $funeralNews->id)
                    ->update(['note_text' => $noteData['note_text']]);
            }
        }
    }

    // เพิ่ม Note ใหม่
    if (isset($request->notes['new'])) {
        foreach ($request->notes['new'] as $newNote) {
            if (!empty($newNote['note_text'])) {
                Note::create([
                    'funeral_news_id' => $funeralNews->id,
                    'note_text' => $newNote['note_text'],
                ]);
            }
        }
    }

    return redirect()->route('funeral-news.index')->with('success', 'อัปเดตข่าวงานศพสำเร็จ');
}

    /**
     * ลบข่าวงานศพ.
     */
    public function destroy($id)
    {
        $funeralNews = FuneralNews::findOrFail($id);
        $funeralNews->delete();

        return redirect()->route('funeral-news.index')->with('success', 'ลบข่าวงานศพสำเร็จ');
    }
}
