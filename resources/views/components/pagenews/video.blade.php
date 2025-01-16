<div class="flex items-center justify-center">
    <div class="container mx-auto p-4">
        <h1 class="mt-2 flex justify-start p-4 text-6xl font-bold text-gray-800">ข่าววิดีโอ</h1>

        <!-- แสดงข่าววิดีโอ -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @forelse($videoNews as $news)
                <div class="bg-white rounded-lg border p-4 shadow-md hover:shadow-lg transition flex flex-col h-full min-h-[300px]">
                    <!-- แสดงวิดีโอ -->
                    @php
                        $videoFile = $news->newsFiles->firstWhere(function($file) {
                            $extension = pathinfo($file->news_file, PATHINFO_EXTENSION);
                            return in_array(strtolower($extension), ['mp4', 'avi', 'mov']);
                        });
                    @endphp
                    @if ($videoFile)
                        <video controls class="w-full h-48 mb-4 rounded-lg">
                            <source src="{{ asset('files/news/' . $videoFile->news_file) }}" type="video/{{ pathinfo($videoFile->news_file, PATHINFO_EXTENSION) }}">
                            เบราว์เซอร์ของคุณไม่รองรับการเล่นวิดีโอ
                        </video>
                    @endif

                    <!-- หัวข้อข่าว -->
                    <h3 class="text-lg font-bold mb-2 text-gray-800">{{ Str::limit($news->news_title, 30, '...') }}</h3>

                    <!-- เนื้อหาข่าว -->
                    <p class="text-gray-700 text-sm mb-4 flex-grow">
                        {{ Str::limit($news->news_detail, 100, '...') }}
                    </p>

                     <!-- ส่วนล่างสุด -->
                     <div class="mt-auto"> 
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
                <p class="text-gray-500">ไม่มีข่าววิดีโอ</p>
            @endforelse
        </div>

   

    </div>
</div>

     