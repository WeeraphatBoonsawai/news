<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        // ค้นหาผู้ใช้ตามชื่อ (ถ้ามีคำค้นหา)
        $users = User::when($query, function ($q) use ($query) {
            $q->where('name', 'like', '%' . $query . '%');
        })->get();

        return view('users.index', compact('users', 'query'));
    }

    public function updateStatus(Request $request, $id)
    {
        // ค้นหาผู้ใช้ตาม ID
        $user = User::findOrFail($id);

        // อัปเดตสถานะ
        $user->status = $request->input('status');
        $user->save();

        return redirect()->route('users.index')->with('success', 'สถานะถูกเปลี่ยนเรียบร้อยแล้ว');
    }
}
