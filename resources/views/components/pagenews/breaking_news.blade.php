<div class="flex items-center justify-center">
    <div class="container mx-auto p-4">
        <h1 class="mt-2 flex justify-start p-4 text-6xl font-bold text-gray-800">ข่าวด่วน!</h1>

        <!-- แสดงข่าวด่วน -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
            @forelse($breakingNews as $news)
                <div class="bg-white rounded-lg border p-4 shadow-md hover:shadow-lg transition flex flex-col h-full min-h-[260px]">                   
                    <!-- หัวข้อข่าว -->
                    <div class="font-bold text-xl mb-2 mt-2">
                        {{ Str::limit($news->news_title, 20, '...') }}
                    </div>

                    <!-- เนื้อหาข่าว -->
                    <p class="text-gray-700 text-base mb-4 flex-grow">
                        {{ Str::limit($news->news_detail, 100, '...') }}
                    </p>

                    <!-- ส่วนล่างสุด -->
                    <div class="mt-auto"> 
                        <p class="text-gray-600 text-sm">ประเภทข่าว: {{ $news->news_type->type_name ?? '-' }}</p>
                        <p class="text-gray-600 text-sm">หน่วยงาน: {{ $news->agency->agency_name ?? '-' }}</p>
                        <p class="text-gray-600 text-sm">จำนวนการอ่าน : {{ $news->views }} ครั้ง</p>
                        <a 
                            href="{{ route('viewNews.show', $news->id) }}" 
                            class="text-blue-500 hover:underline mt-2 inline-block"
                        >
                            อ่านเพิ่มเติม
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-gray-500">ไม่มีข่าวด่วน</p>
            @endforelse
        </div>
    </div>
</div>