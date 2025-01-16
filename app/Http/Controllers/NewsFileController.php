<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewsFile;

class NewsFileController extends Controller
{
    /**
     * Remove the specified file from storage.
     */
    public function destroy($id)
    {
        $file = NewsFile::findOrFail($id);
        $filePath = public_path('files/news/' . $file->news_file);

        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $file->delete();

        return redirect()->back()->with('success', 'ลบไฟล์เรียบร้อยแล้ว');
    }
}
