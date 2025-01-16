<div class="flex items-center justify-center">
    <div class="container mx-auto p-4">

<!-- Header -->
<h1 class="flex justify-start p-4 text-6xl font-bold text-gray-800"># แท็ก</h1>

<div class="space-y-2 p-2">
    @forelse ($newsTypes as $types)
        <a 
            href="{{ route('viewNews.index', ['news_type' => $types->type_name]) }}" 
            class="bg-[#26806c] hover:bg-[#88C273] text-white text-xs font-semibold rounded px-4 py-2 transition inline-block"
        >
            # {{ $types->type_name }}
        </a>
    @empty
        <p class="text-gray-500 text-xs">ไม่มีข้อมูล</p>
    @endforelse
</div>

</div>
</div>