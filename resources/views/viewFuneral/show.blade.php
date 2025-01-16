@extends('components.user.navbar')

@section('content')

<div class="bg-white mt-20">
    <div class="container mx-auto p-4">
        <h1 class="text-4xl font-bold text-gray-800 mb-6">รายละเอียดงานศพ</h1>
        
        <div class="bg-white rounded-lg border p-6 shadow-md">
            <div class="mb-4">
                <h2 class="text-2xl font-bold text-gray-800">ชื่อผู้เสียชีวิต: {{ $funeral->deceased }}</h2>
            </div>

            <div class="mb-4">
                <p class="text-gray-600 text-lg">เจ้าหน้าที่: {{ $funeral->officer_name ?? '-' }}</p>
            </div>

            <div class="mb-4">
                <p class="text-gray-600 text-lg">ความสัมพันธ์: {{ $funeral->relationship ?? '-' }}</p>
            </div>

            <div class="mb-4">
                <p class="text-gray-600 text-lg">สถานที่จัดงาน: {{ $funeral->funeral_location ?? '-' }}</p>
            </div>

            <div class="mb-4">
                <p class="text-gray-600 text-lg">วันที่เริ่มงานศพ: {{ $funeral->start_funeral ?? '-' }}</p>
                <p class="text-gray-600 text-lg">วันที่สิ้นสุดงานศพ: {{ $funeral->end_funeral ?? '-' }}</p>
            </div>

            <div class="mb-4">
                <p class="text-gray-600 text-lg">เวลาสวดอภิธรรม: {{ $funeral->pray_funeral ?? '-' }}</p>
            </div>

            <div class="mb-4">
                <p class="text-gray-600 text-lg">วันที่เผาศพ: {{ $funeral->cremation_ceremony ?? '-' }}</p>
                <p class="text-gray-600 text-lg">สถานที่เผาศพ: {{ $funeral->cremation_ceremon_location ?? '-' }}</p>
            </div>

            <div class="mb-4">
                <p class="text-gray-600 text-lg">จำนวนการดูข้อมูล: {{ $funeral->views }} ครั้ง</p>
            </div>

            <a 
                href="{{ route('viewFuneral.index') }}" 
                class="mt-4 inline-block bg-gray-800 text-white py-2 px-4 rounded hover:bg-gray-700 transition"
            >
                กลับไปหน้ารายการงานศพ
            </a>
        </div>
    </div>
</div>

@endsection
