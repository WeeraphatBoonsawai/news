@extends('components.admin.navbar')

@section('content')
<div class="container mx-auto mt-16 p-6 bg-white shadow-lg rounded-lg">
    <h1 class="text-[#7d8a99] text-4xl font-bold mt-2 mb-6">
        รายการข่าว
    </h1>

    <!-- ปุ่มเพิ่มข่าว -->
    <div class="flex justify-between items-center mb-6">
        <a href="{{ route('news.create') }}" class="bg-[#26806c] text-white px-4 py-2 rounded-lg hover:bg-[#5DB996]">
            เพิ่มข่าวใหม่
        </a>
    </div>

    <!-- หมายเหตุ -->
    <p class="text-gray-600 text-sm mb-4">
        <span class="font-medium">หมายเหตุ:</span>
        @forelse ($news_type as $types)
            <span>{{ $loop->iteration }}. {{ $types->type_name }}</span>,
        @empty
            ไม่มีข้อมูล
        @endforelse
    </p>

    <!-- ฟอร์มค้นหา -->
    <form action="{{ route('news.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <!-- ค้นหาหัวข้อข่าว -->
        <div>
            <label for="search_title" class="block text-gray-700 font-medium">ค้นหาหัวข้อข่าว</label>
            <input 
                type="text" 
                id="search_title" 
                name="search_title" 
                value="{{ request('search_title') }}" 
                placeholder="พิมพ์หัวข้อข่าว" 
                class="w-full p-2 border rounded-lg"
            />
        </div>

        <!-- ค้นหาประเภทข่าว -->
        <div>
            <label for="news_type" class="block text-gray-700 font-medium">ประเภทข่าว</label>
            <select 
                id="news_type" 
                name="news_type" 
                class="w-full p-2 border rounded-lg"
            >
                <option value="">ทั้งหมด</option>
                @foreach ($news_type as $type)
                    <option 
                        value="{{ $type->id }}" 
                        {{ request('news_type') == $type->id ? 'selected' : '' }}
                    >
                        {{ $type->type_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- ค้นหาสถานะข่าว -->
        <div>
            <label for="news_status" class="block text-gray-700 font-medium">สถานะข่าว</label>
            <select 
                id="news_status" 
                name="news_status" 
                class="w-full p-2 border rounded-lg"
            >
                <option value="">ทั้งหมด</option>
                <option value="start" {{ request('news_status') == 'start' ? 'selected' : '' }}>เริ่ม</option>
                <option value="stop" {{ request('news_status') == 'stop' ? 'selected' : '' }}>หยุด</option>
            </select>
        </div>

        <!-- ปุ่มค้นหา -->
        <div class="flex items-end">
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
                    <th class="p-4 text-center">หัวข้อข่าว</th>
                    <th class="p-4 text-center">ประเภท</th>
                    <th class="p-4 text-center ">สถานะ</th>
                    <th class="p-4 text-center">วันที่เริ่ม</th>
                    <th class="p-4 text-center">วันที่สิ้นสุด</th>
                    <th class="p-4 text-center">ผู้ใช้งานที่อัปโหลด</th>
                    <th class="p-4 text-center">จัดการ</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($news as $item)
                    <tr class="hover:bg-gray-100 border-b">
                        <td class="p-4 text-gray-700 text-center">{{ $item->id }}</td>
                        <td class="p-4 text-gray-700">{{ Str::limit($item->news_title, 30, '...') }}</td>
                        <td class="p-4 text-gray-700">{{ $item->news_type->type_name ?? 'N/A' }}</td>
                        <td class="p-4 text-center">
                            <span class="px-2 py-1 rounded-lg {{ $item->news_status === 'start' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $item->news_status === 'start' ? 'เริ่ม' : 'หยุด' }}
                            </span>
                        </td>
                        <td class="p-4 text-gray-700 text-center">{{ $item->start_announcing }}</td>
                        <td class="p-4 text-gray-700 text-center">{{ $item->end_announcing }}</td>
                        <td class="p-4 text-gray-700 text-center">{{ $item->user->name ?? 'ไม่ทราบชื่อ' }}</td>
                        <td class="p-4 text-center">
                            <a 
                                href="{{ route('news.edit', $item->id) }}" 
                                class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600"
                            >
                                แก้ไข
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-4 text-center text-gray-500">ไม่มีข่าวที่จะแสดง</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6 flex justify-end">
        {{ $news->links() }}
    </div>
</div>
@endsection
