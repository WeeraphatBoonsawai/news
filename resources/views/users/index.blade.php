@extends('components.admin.navbar')

@section('content')
<div class="container mx-auto mt-16 p-6 bg-white shadow-lg rounded-lg">
    <h1 class="text-[#7d8a99] text-4xl font-bold mt-2 mb-4">
        จัดการสมาชิก
    </h1>

    <div class="flex justify-between border-t mb-6">
        <div class="text-[#525456] text-lg flex gap-2 items-center mt-4">
            <form method="GET" action="{{ url()->current() }}" class="flex items-center gap-2">
                <label for="search" class="text-sm font-medium">ค้นหา:</label>
                <input 
                    id="search" 
                    name="query" 
                    class="border p-2 pl-3 rounded-lg w-64" 
                    type="text" 
                    placeholder="ค้นหาชื่อผู้ใช้" 
                    value="{{ $query ?? '' }}" 
                />
                <button type="submit" class="bg-[#26806c] text-white p-2 rounded-lg hover:bg-[#5DB996]">
                    ค้นหา
                </button>
            </form>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="min-w-full border">
            <thead>
                <tr class="text-[#525456] text-lg border-b bg-gray-100">
                    <th class="p-4 text-left">ชื่อ</th>
                    <th class="p-4 text-left">อีเมล</th>
                    <th class="p-4 text-left">สถานะ</th>
                    <th class="p-4 text-left">การกระทำ</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr class="border-b">
                        <td class="p-4">
                            <p class="text-[#525456]">{{ $user->name }}</p>
                        </td>
                        <td class="p-4">
                            <p class="text-[#525456]">{{ $user->email }}</p>
                        </td>
                        <td class="p-4">
                            <p class="text-[#525456]">{{ $user->status }}</p>
                        </td>
                        <td class="p-4">
                            <form action="{{ route('users.updateStatus', $user->id) }}" method="POST">
                                @csrf
                                <select name="status" class="border p-1 rounded-lg">
                                    <option value="Admin" {{ $user->status == 'Admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="Editor" {{ $user->status == 'Editor' ? 'selected' : '' }}>Editor</option>
                                    <option value="User" {{ $user->status == 'User' ? 'selected' : '' }}>User</option>
                                </select>
                                <button type="submit" class="bg-[#8fd3ff] text-[#00609e] p-1 rounded-lg mt-2">เปลี่ยนสถานะ</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="p-4 text-center text-[#525456]">
                            ไม่พบข้อมูลสมาชิก
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
