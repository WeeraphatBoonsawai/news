@extends('components.user.navbar')

@section('content')

<div class="bg-white mt-20">
    <h1 class="flex justify-start p-4 text-6xl font-bold text-gray-800 ml-12">งานศพล่าสุด</h1>
    <div class="flex items-center justify-center">
        <div class="container mx-auto p-4">
            <!-- ฟอร์มค้นหา -->
            <form action="{{ route('viewFuneral.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                <input 
                    type="text" 
                    name="officer_name" 
                    placeholder="ค้นหาชื่อเจ้าหน้าที่" 
                    value="{{ request('officer_name') }}" 
                    class="p-2 border rounded"
                >
                <input 
                    type="text" 
                    name="deceased" 
                    placeholder="ค้นหาชื่อผู้เสียชีวิต" 
                    value="{{ request('deceased') }}" 
                    class="p-2 border rounded"
                >
                <input 
                    type="text" 
                    name="funeral_location" 
                    placeholder="ค้นหาสถานที่จัดงาน" 
                    value="{{ request('funeral_location') }}" 
                    class="p-2 border rounded"
                >
                <button 
                    type="submit" 
                    class="p-2 bg-[#26806c] text-white rounded hover:bg-[#5DB996] transition"
                >
                    ค้นหา
                </button>
            </form>

            <!-- แสดงข้อมูลงานศพ -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach($funeralList as $funeral)
                <div class="bg-white rounded-lg border p-4 shadow-md hover:shadow-lg transition flex flex-col h-full min-h-[300px]">
                    <div class="font-bold text-xl mb-2">
                        {{ $funeral->deceased }}
                    </div>
                    <p class="text-gray-700 text-base mb-4 flex-grow">
                        สถานที่: {{ $funeral->funeral_location ?? '-' }}
                    </p>
                    <div class="mt-auto">
                        <p class="text-gray-600 text-sm">เจ้าหน้าที่: {{ $funeral->officer_name ?? '-' }}</p>
                        <p class="text-gray-600 text-sm">วันที่เริ่ม: {{ $funeral->start_funeral ?? '-' }}</p>
                        <p class="text-gray-600 text-sm">วันที่เผาศพ: {{ $funeral->cremation_ceremony ?? '-' }}</p>
                        <a 
                            href="{{ route('viewFuneral.show', $funeral->id) }}" 
                            class="text-blue-500 hover:underline mt-2 inline-block"
                        >
                            รายละเอียดเพิ่มเติม
                        </a>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6 flex justify-end">
                {{ $funeralList->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
