<div class="bg-[#c5c6c6] text-white p-4">
    <h1 class="flex justify-start p-4 text-6xl font-bold text-gray-800">ภาพกิจกรรม</h1>
    <div class="container mx-auto max-w-screen-2xl">
        

        <!-- เนื้อหา -->
        <div class="flex flex-col lg:flex-row gap-6 mt-6">
            <!-- รูปกิจกรรมย่อย -->
            <div class="grid grid-cols-2 gap-4 flex-1">
                @foreach ($otherActivityNews as $news)
                    @php
                        $file = $news->newsFiles->first();
                        $filePath = $file ? asset('files/news/' . $file->news_file) : 'default-image.jpg';
                    @endphp
                    <div class="bg-white p-3 rounded-lg hover:bg-[#EEEEEE] transition flex flex-col justify-between">
                        <div class="relative overflow-hidden rounded-lg">
                            <img src="{{ $filePath }}" alt="{{ $news->news_title }}" 
                                 class="w-full rounded-lg aspect-[4/3] object-cover transform transition-transform duration-500 hover:scale-105 hover:brightness-110">
                        </div>
                        <div class="mt-4 flex flex-col justify-between flex-grow">
                            <h3 class="text-gray-700 text-sm font-bold">{{ Str::limit($news->news_title, 50, '...') }}</h3>
                            <p class="text-sm font-light text-gray-600">
                                {{ Str::limit($news->news_detail, 50, '...') }}
                            </p>
                            <div class="mt-auto">
                                <p class="text-gray-600 text-sm">หน่วยงาน: {{ $news->agency->agency_name ?? '-' }}</p>
                                <p class="text-gray-600 text-sm">จำนวนการอ่าน : {{ $news->views }} ครั้ง</p>
                                <a href="{{ route('viewNews.show', $news->id) }}" class="text-blue-500 hover:underline mt-2 inline-block">อ่านเพิ่มเติม</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- รูปกิจกรรมหลัก -->
            @if ($mainActivityNews)
                @php
                    $mainFile = $mainActivityNews->newsFiles->first();
                    $mainFilePath = $mainFile ? asset('files/news/' . $mainFile->news_file) : 'default-image.jpg';
                @endphp
                 
                <div class="relative flex-[2] overflow-hidden group">
                    <a href="{{ route('viewNews.show', $mainActivityNews->id) }}" class="block">
                        <div class="relative overflow-hidden rounded-lg aspect-[6/4.7]">
                            <img src="{{ $mainFilePath }}" alt="{{ $mainActivityNews->news_title }}" 
                                 class="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-105 group-hover:brightness-110">
                        </div>
                        <div class="absolute inset-0 bg-black bg-opacity-50 flex items-end p-4 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <div>
                                <p class="text-sm font-light text-gray-300">
                                    {{ Str::limit($mainActivityNews->news_detail, 200, '...') }}
                                </p>
                                <h2 class="text-lg font-bold text-white">
                                    {{ Str::limit($mainActivityNews->news_title, 100, '...') }}
                                </h2>
                            </div>
                        </div>
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>