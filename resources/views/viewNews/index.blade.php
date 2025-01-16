@extends('components.user.navbar')

@section('content')

<div class="bg-white mt-20">
    <h1 class="flex justify-start p-4 text-6xl font-bold text-gray-800 ml-12">ข่าวล่าสุด</h1>
    <div class="flex items-center justify-center">
        <div class="container mx-auto p-4">
            <!-- ฟอร์มค้นหา -->
            <form action="{{ route('viewNews.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                <!-- ค้นหา news_type -->
                <input 
                    type="text" 
                    name="news_type" 
                    placeholder="ค้นหาประเภทข่าว" 
                    value="{{ request('news_type') }}" 
                    class="p-2 border rounded"
                >
        
                <!-- ค้นหา agency -->
                <input 
                    type="text" 
                    name="agency" 
                    placeholder="ค้นหาหน่วยงาน" 
                    value="{{ request('agency') }}" 
                    class="p-2 border rounded"
                >
        
                <!-- ค้นหา news_title -->
                <input 
                    type="text" 
                    name="news_title" 
                    placeholder="ค้นหาชื่อข่าว" 
                    value="{{ request('news_title') }}" 
                    class="p-2 border rounded"
                >
        
                <!-- ปุ่มค้นหา -->
                <button 
                    type="submit" 
                    class="p-2 bg-[#26806c] text-white rounded hover:bg-[#5DB996] transition"
                >
                    ค้นหา
                </button>
            </form>
        
            <!-- แสดงข่าว -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($newsList as $news)
                <div class="bg-white rounded-lg border p-4 shadow-md hover:shadow-lg transition flex flex-col h-full min-h-[300px]">
                    <!-- หัวข้อข่าว -->
                    <div class="font-bold text-xl mb-2">
                        {{ Str::limit($news->news_title, 30, '...') }}
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
                @endforeach
            </div>
            
            <!-- Pagination -->
     <div class="mt-6 flex justify-end">
        {{ $newsList->links() }}
    </div>

        </div>
        
    </div>

    
</div>
@endsection