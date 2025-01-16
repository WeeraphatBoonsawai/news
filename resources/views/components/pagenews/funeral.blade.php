<div class="container mx-auto p-4 bg-black">
    <h1 class="text-4xl font-bold mb-4 text-white">ข่าวงานศพ</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
        @forelse($funeralgNews as $news)
            <div class="bg-white rounded-lg border p-4 shadow-md hover:shadow-lg transition flex flex-col h-full min-h-[300px]">
                <div class="font-bold text-xl mb-2">ขอแสดงความเสียใจ</div>
                <p class="text-gray-700 text-base mb-4 flex-grow">{{ Str::limit($news->deceased, 100, '...') }}</p>
                <p class="text-gray-600 text-sm">จำนวนการอ่าน: {{ $news->views }} ครั้ง</p>
               
                <a href="{{ route('viewNews.funeralshow', $news->id) }}" class="text-blue-500 hover:underline mt-2 inline-block">
                    อ่านเพิ่มเติม
                </a>

            </div>
        @empty
            <p class="text-gray-500">ไม่มีข่าวงานศพ</p>
        @endforelse
    </div>
</div>
