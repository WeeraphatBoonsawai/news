<!-- Main Container -->
<div class="max-w-screen-3xl mx-auto p-4">
    <!-- Header -->
    <h1 class="mt-10 flex justify-start p-4 text-6xl font-bold text-gray-800">ข่าวล่าสุด</h1>

    <!-- Content Layout -->
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 md:gap-8">
        <!-- Left Section (Main News Image) -->
        <div class="col-span-1 md:col-span-4 h-auto md:h-[50rem]">
            <div class="relative overflow-hidden rounded-lg shadow-lg h-full">
                <img src="/images/background.jpg" 
                     alt="ข่าวหลัก" 
                     class="w-full h-full object-cover transform hover:scale-105 transition duration-300">
                <div class="absolute bottom-0 left-0 bg-gradient-to-t from-black to-transparent text-white p-4">
                    <h2 class="text-2xl font-bold">หัวข้อข่าวหลัก</h2>
                </div>
            </div>
        </div>

        <!-- Right Section (News Cards) -->
        <div class="flex flex-col gap-4 h-auto md:h-[50rem] col-span-1 md:col-span-1 overflow-auto">
            @foreach ($news as $item)
            <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition duration-300 flex flex-col flex-grow">
                <h3 class="text-lg font-bold mb-2 text-gray-800">{{ Str::limit($item->news_title, 30, '...') }}</h3>
                <p class="text-sm text-gray-600 flex-grow">{{ Str::limit($item->news_detail, 80) }}</p>
                <div>
                    <p class="text-sm text-gray-600 flex-grow">จำนวนการอ่าน : {{ $item->views }} ครั้ง</p>
                    <a href="{{ route('viewNews.show', $item->id) }}" class="text-blue-500 mt-2 inline-block hover:underline">อ่านเพิ่มเติม</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Footer Link -->
    <div class="text-right mt-4">
        <a href="#" class="text-blue-600 font-semibold hover:underline">ดูทั้งหมด &rarr;</a>
    </div>
</div>