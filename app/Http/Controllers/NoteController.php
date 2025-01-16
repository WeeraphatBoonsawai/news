<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Store a newly created note.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'note_text' => 'required|string|max:255',
            'funeral_news_id' => 'required|exists:funeral_news,id',
        ]);

        Note::create([
            'funeral_news_id' => $validated['funeral_news_id'],
            'note_text' => $validated['note_text'],
        ]);

        return redirect()->back()->with('success', 'เพิ่มหมายเหตุสำเร็จ');
    }

    /**
     * Delete a note.
     */
    public function destroy(Note $note)
    {
        $note->delete();
        return redirect()->back()->with('success', 'ลบหมายเหตุสำเร็จ');
    }
}
