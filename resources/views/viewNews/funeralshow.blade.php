@extends('components.user.navbar')

@section('content')
<div class="container mx-auto p-6">

    <h1 class="text-4xl font-extrabold text-gray-800 mb-8 mt-12">รายละเอียดข่าวงานศพ</h1>

    <div class="bg-white p-6 border border-gray-200 rounded-lg shadow-md">

        <!-- ข้อมูลผู้เสียชีวิต -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">ข้อมูลผู้เสียชีวิต</h2>
            <p class="text-gray-600"><strong class="font-semibold">ชื่อผู้เสียชีวิต:</strong> {{ $funeralNews->deceased }}</p>
            <p class="text-gray-600"><strong class="font-semibold">ความสัมพันธ์:</strong> {{ $funeralNews->relationship }}</p>
        </div>

        <!-- รายละเอียดงานศพ -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">รายละเอียดงานศพ</h2>
            <p class="text-gray-600"><strong class="font-semibold">สถานที่ตั้งศพ:</strong> {{ $funeralNews->funeral_location }}</p>
            <p class="text-gray-600"><strong class="font-semibold">วันที่เริ่มตั้งศพ:</strong> {{ $funeralNews->start_funeral ?? 'ไม่ระบุ' }}</p>
            <p class="text-gray-600"><strong class="font-semibold">วันที่สิ้นสุดตั้งศพ:</strong> {{ $funeralNews->end_funeral ?? 'ไม่ระบุ' }}</p>
            <p class="text-gray-600"><strong class="font-semibold">เวลาสวดอภิธรรม:</strong> {{ $funeralNews->pray_funeral ?? 'ไม่ระบุ' }}</p>
            <p class="text-gray-600"><strong class="font-semibold">วันที่พิธีฌาปนกิจ:</strong> {{ $funeralNews->cremation_ceremony ?? 'ไม่ระบุ' }}</p>
            <p class="text-gray-600"><strong class="font-semibold">สถานที่ฌาปนกิจ:</strong> {{ $funeralNews->cremation_ceremon_location }}</p>
        </div>

        <!-- ข้อมูลเจ้าหน้าที่ -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">ข้อมูลเจ้าหน้าที่</h2>
            <p class="text-gray-600"><strong class="font-semibold">ชื่อเจ้าหน้าที่:</strong> {{ $funeralNews->officer_name }}</p>
            <p class="text-gray-600"><strong class="font-semibold">สถานที่ทำงาน:</strong> {{ $funeralNews->officer_location }}</p>
        </div>

        <!-- หมายเหตุ -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">หมายเหตุ</h2>
            @if ($funeralNews->notes->isEmpty())
                <p class="text-gray-600">ไม่มีหมายเหตุที่เกี่ยวข้อง</p>
            @else
                <ul class="list-disc pl-5 text-gray-600">
                    @foreach ($funeralNews->notes as $note)
                        <li>{{ $note->note_text }} <span class="text-sm text-gray-500">({{ $note->created_at->diffForHumans() }})</span></li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- พวงหรีด -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">ข้อมูลพวงหรีด</h2>
            @if ($funeralNews->wreath && $funeralNews->wreath->wreath_images)
                <img src="{{ asset('/' . $funeralNews->wreath->wreath_images) }}" alt="พวงหรีด" class="w-full max-w-md object-cover rounded-lg shadow-md">
            @else
                <p class="text-gray-600">ไม่มีข้อมูลพวงหรีด</p>
            @endif
        </div>

        <!-- สถานะงานศพ -->
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">สถานะงานศพ</h2>
            <p class="text-gray-600">
                <strong class="font-semibold">สถานะ:</strong> 
                <span class="px-3 py-1 rounded-full text-white {{ $funeralNews->funeral_news_status === 'start' ? 'bg-green-500' : 'bg-red-500' }}">
                    {{ $funeralNews->funeral_news_status === 'start' ? 'เริ่มต้น' : 'สิ้นสุด' }}
                </span>
            </p>
        </div>

    </div>

    <!-- ปุ่มย้อนกลับ -->
    <a href="{{ route('viewNews.index') }}" class="mt-6 inline-block text-blue-600 hover:underline text-lg font-medium">
        ย้อนกลับ
    </a>

</div>
@endsection
