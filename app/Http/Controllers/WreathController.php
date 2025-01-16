<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wreath;
use Illuminate\Support\Facades\Storage;

class WreathController extends Controller
{
    public function index()
    {
        $wreaths = Wreath::paginate(6); // แบ่งข้อมูลเป็น รายการต่อหน้า
        return view('wreath.index', compact('wreaths'));
    }
    // Function to show the upload form
    public function create()
    {
        return view('wreath.upload');
    }

    // Function to handle file upload
    public function store(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'wreath_images' => 'required|image|mimes:jpeg,png,jpg,gif|max:10048',
        ]);

        // Store the uploaded file in public/images/wreath
        $path = $request->file('wreath_images')->move(public_path('images/wreath'), $request->file('wreath_images')->getClientOriginalName());

        // Save file path to the database
        Wreath::create(['wreath_images' => 'images/wreath/' . $request->file('wreath_images')->getClientOriginalName()]);

        return redirect()->route('wreath.index')->with('success', 'เพิ่มพวงหรีดสำเร็จแล้ว!');
    }

    // Function to show the edit form
    public function edit($id)
    {
        $wreath = Wreath::findOrFail($id);
        return view('wreath.edit', compact('wreath'));
    }

    // Function to update the file
    public function update(Request $request, $id)
    {
        // Validate the uploaded file
        $request->validate([
            'wreath_images' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:210048',
        ]);

        $wreath = Wreath::findOrFail($id);

        if ($request->hasFile('wreath_images')) {
            // Delete the old file if it exists
            if (file_exists(public_path($wreath->wreath_images))) {
                unlink(public_path($wreath->wreath_images));
            }

            // Store the new file
            $path = $request->file('wreath_images')->move(public_path('images/wreath'), $request->file('wreath_images')->getClientOriginalName());

            // Update the file path in the database
            $wreath->wreath_images = 'images/wreath/' . $request->file('wreath_images')->getClientOriginalName();
        }

        $wreath->save();

        return redirect()->route('wreath.index')->with('success', 'แก้ไขพวงหรีดสำเร็จแล้ว!');
    }
   
}
