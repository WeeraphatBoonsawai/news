@extends('components.admin.navbar')

@section('content')
<div class="container mx-auto mt-16 p-6 bg-white shadow-lg rounded-lg">
    <h1 class="text-[#7d8a99] text-4xl font-bold mt-2 mb-6">
        รายการข่าวงานศพ
    </h1>

    <!-- ปุ่มเพิ่มข่าว -->
    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('funeral_news.create') }}" class="bg-[#26806c] text-white px-4 py-2 rounded-lg hover:bg-[#5DB996]">
            เพิ่มข่าวงานศพ
        </a>
    </div>

    <!-- ฟอร์มค้นหา -->
<form action="{{ route('funeral-news.index') }}" method="GET" class="flex flex-wrap gap-4 items-end mb-6">
    <!-- ค้นหาชื่อเจ้าหน้าที่ -->
    <div class="flex-1">
        <label for="search_officer" class="block text-gray-700 font-medium">ชื่อเจ้าหน้าที่</label>
        <input 
            type="text" 
            id="search_officer" 
            name="search_officer" 
            value="{{ request('search_officer') }}" 
            placeholder="พิมพ์ชื่อเจ้าหน้าที่" 
            class="w-full p-2 border rounded-lg"
        />
    </div>

    <!-- ค้นหาชื่อผู้เสียชีวิต -->
    <div class="flex-1">
        <label for="search_deceased" class="block text-gray-700 font-medium">ชื่อผู้เสียชีวิต</label>
        <input 
            type="text" 
            id="search_deceased" 
            name="search_deceased" 
            value="{{ request('search_deceased') }}" 
            placeholder="พิมพ์ชื่อผู้เสียชีวิต" 
            class="w-full p-2 border rounded-lg"
        />
    </div>

    <!-- ค้นหาสถานที่จัดงานศพ -->
    <div class="flex-1">
        <label for="search_location" class="block text-gray-700 font-medium">สถานที่จัดงานศพ</label>
        <input 
            type="text" 
            id="search_location" 
            name="search_location" 
            value="{{ request('search_location') }}" 
            placeholder="พิมพ์สถานที่จัดงานศพ" 
            class="w-full p-2 border rounded-lg"
        />
    </div>

    <!-- ค้นหาสถานะ -->
    <div class="flex-1">
        <label for="search_status" class="block text-gray-700 font-medium">สถานะ</label>
        <select 
            id="search_status" 
            name="search_status" 
            class="w-full p-2 border rounded-lg"
        >
            <option value="">ทั้งหมด</option>
            <option value="start" {{ request('search_status') == 'start' ? 'selected' : '' }}>เริ่ม</option>
            <option value="stop" {{ request('search_status') == 'stop' ? 'selected' : '' }}>หยุด</option>
        </select>
    </div>

    <!-- ปุ่มค้นหา -->
    <div>
        <button 
            type="submit" 
            class="bg-[#26806c] text-white px-4 py-2 rounded-lg hover:bg-[#5DB996]"
        >
            ค้นหา
        </button>
    </div>
</form>

    

    <!-- ตารางรายการข่าว -->
    <div class="overflow-x-auto">
        <table class="min-w-full border rounded-lg">
            <thead>
                <tr class="text-[#525456] text-lg border-b bg-gray-100">
                    <th class="p-4 text-center">#</th>
                    <th class="p-4 text-center">ชื่อเจ้าหน้าที่</th>
                    <th class="p-4 text-center">ชื่อผู้เสียชีวิต</th>
                    <th class="p-4 text-center">สถานที่จัดงานศพ</th>
                    <th class="p-4 text-center">สถานะ</th>
                    <th class="p-4 text-center">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($funeralNews as $news)
                    <tr class="hover:bg-gray-100 border-b">
                        <td class="p-4 text-gray-700 text-center">{{ $news->id }}</td>
                        <td class="p-4 text-gray-700">{{ $news->officer_name }}</td>
                        <td class="p-4 text-gray-700">{{ $news->deceased }}</td>
                        <td class="p-4 text-gray-700">{{ $news->funeral_location }}</td>
                        <td class="p-4 text-center">
                            <span class="px-2 py-1 rounded-lg {{ $news->funeral_news_status === 'start' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $news->funeral_news_status === 'start' ? 'เริ่ม' : 'หยุด' }}
                            </span>
                        </td>
                        <td class="p-4 text-center">
                            <a 
                                href="{{ route('funeral-news.edit', $news->id) }}" 
                                class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600"
                            >
                                แก้ไข
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-4 text-center text-gray-500">ไม่มีข้อมูลข่าวงานศพ</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
