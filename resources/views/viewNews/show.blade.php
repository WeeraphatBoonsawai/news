@extends('components.user.navbar')

@section('content')
<div class="container mx-auto p-6 ">

    
    <h1 class="text-4xl font-extrabold text-gray-800 mb-8 mt-12">{{ $news->news_title }}</h1>

    <div class="bg-white p-6 border border-gray-200 rounded-lg shadow-md">

        <div class="mb-4">
            <p class="text-gray-600">
                <strong class="text-lg font-semibold text-gray-700">หัวข้อข่าว: </strong> 
                {{ $news->news_title }}</p>
        </div>

        <div class="mb-4">
            <p class="text-lg font-semibold text-gray-700"><strong>รายละเอียด:</strong></p>
            <p class="text-gray-600">{{ $news->news_detail }}</p>
        </div>
        
        <div class="mb-4">
            <p class="text-lg font-semibold text-gray-700"><strong>ลิงก์ข่าว:</strong></p>
            <a href="{{ $news->news_link }}" target="_blank" class="text-blue-600 hover:underline">{{ $news->news_link }}</a>
        </div>
        
        <div class="mb-4">
            <p class="text-lg font-semibold text-gray-700"><strong>สถานะ:</strong></p>
            <p class="text-gray-600">{{ $news->news_status === 'start' ? 'ประชาสัมพันธ์' : 'หยุดประชาสัมพันธ์' }}</p>
        </div>
        
        <div class="mb-4">
            <p class="text-lg font-semibold text-gray-700"><strong>วันที่ประกาศ:</strong></p>
            <p class="text-gray-600">{{ $news->start_announcing }} ถึง {{ $news->end_announcing }}</p>
        </div>
        
        <div class="mb-4">
            <p class="text-lg font-semibold text-gray-700"><strong>ประเภทข่าว:</strong></p>
            <p class="text-gray-600">{{ $news->news_type->type_name ?? '-' }}</p>
        </div>
        
        <div class="mb-4">
            <p class="text-lg font-semibold text-gray-700"><strong>หน่วยงานที่เกี่ยวข้อง:</strong></p>
            <p class="text-gray-600">{{ $news->agency->agency_name ?? '-' }}</p>
        </div>

          <!-- ส่วนแสดงวิดีโอ -->
@php
$videoFiles = $news->newsFiles->filter(function($file) {
    $extension = pathinfo('files/news/' . $file->news_file, PATHINFO_EXTENSION);
    return in_array(strtolower($extension), ['mp4', 'avi', 'mov']);
});
@endphp

@if ($news->newsFiles->count() > 0)
<div class="{{ $videoFiles->count() === 1 ? 'w-full max-w-5xl mx-auto mb-8' : 'grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8' }}">
    @foreach ($videoFiles as $file)
        @php
            $filePath = 'files/news/' . $file->news_file;
            $extension = pathinfo($filePath, PATHINFO_EXTENSION);
        @endphp
        <div class="{{ $videoFiles->count() === 1 ? '' : 'bg-white p-4 border border-gray-200 rounded-lg shadow-md' }}">
            <video controls class="w-full rounded-lg {{ $videoFiles->count() === 1 ? 'h-auto' : '' }}">
                <source src="{{ asset($filePath) }}" type="video/{{ $extension }}">
                เบราว์เซอร์ของคุณไม่รองรับการเล่นวิดีโอ
            </video>

        </div>
    @endforeach
</div>
@endif

        <div class="mt-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">ไฟล์ที่เกี่ยวข้อง</h2>
            @if($news->newsFiles->count() > 0)
                <div class="space-y-4">
                    @foreach ($news->newsFiles as $file)
                        @php
                            $filePath = 'files/news/' . $file->news_file;
                            $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                            $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']);
                        @endphp
                        @if ($isImage)
                            <!-- แสดงรูปภาพ -->
                            <div>
                                <a href="{{ asset($filePath) }}" target="_blank">
                                    <img src="{{ asset($filePath) }}" alt="ไฟล์รูปภาพ" class="w-full max-w-md object-cover rounded-lg shadow-md">
                                </a>
                            </div>
                        @endif
                    @endforeach
                    @foreach ($news->newsFiles as $file)
                        @php
                            $filePath = 'files/news/' . $file->news_file;
                            $extension = pathinfo($filePath, PATHINFO_EXTENSION);
                            $isImage = in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'webp']);
                        @endphp
                        @if (!$isImage)
                            <!-- แสดงชื่อไฟล์สำหรับเอกสาร -->
                            <div>
                                <a href="{{ asset($filePath) }}" 
                                   class="text-blue-500 hover:underline" 
                                   target="_blank">
                                    {{ basename($file->news_file) }}
                                </a>
                            </div>
                        @endif
                    @endforeach
                </div>
            @else
                <p class="text-gray-600">ไม่มีไฟล์ที่เกี่ยวข้อง</p>
            @endif
        </div>
        
        <div class="mb-4 mt-2">
            <p class="text-lg font-semibold text-gray-700"><strong>ผู้อัปโหลด:</strong></p>
            <p class="text-gray-600">{{ $news->user->name ?? 'ไม่ทราบชื่อ' }}</p>
        </div>
        
    </div>

    <a href="{{ route('viewNews.index') }}" class="mt-6 inline-block text-blue-600 hover:underline text-lg font-medium">
        ย้อนกลับ
    </a>

    <div class="mt-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">ข่าวอื่นๆ</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($randomNews as $item)
                <div class="bg-white p-4 border border-gray-200 rounded-lg shadow-md">
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">
                        <a href="{{ route('viewNews.show', $item->id) }}" class="hover:text-blue-500">{{ $item->news_title }}</a>
                    </h3>
                    <p class="text-sm text-gray-600 mb-4">
                        {{ Str::limit($item->news_detail, 100) }}
                    </p>
                    <a href="{{ route('viewNews.show', $item->id) }}" class="text-blue-500 text-sm hover:underline">อ่านเพิ่มเติม</a>
                </div>
            @endforeach
        </div>
    </div>

</div>

@endsection
